<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;
use App\Tag;
use App\User;
use App\Comment;

use DB;

use Session;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth',['except' => ['viewPost', 'filter']]);
    }
    public function save(Request $request)
    {
    	$this->validate($request,[
    		'title'=>'required',
    		'content'=>'required',
    		'tags'=>'required'
    	]);

    	$post=new Post;

    	$post->title=$request->title;
    	$post->content=$request->content;
    	$post->slug=str_slug($request->title);
    	$post->user_id=Auth::id();

    	$post->save();

    	$post->tags()->attach($request->tags);

    	Session::flash('success','Posted successfully');

    	return redirect()->back();
    }
    public function edit($enc_id)
    {

        $post_id=decrypt($enc_id);
        $post=Post::find($post_id);

        if(Auth::user()==$post->user||Auth::user()->admin())
        {
            return view('post.edit')->with('post',$post);
        }
        else 
        {
            Session::flash('error','You don\'t have permission to do this.');
            return redirect()->back();
        }
    }
    public function update(Request $request)
    {       
        $this->validate($request,[
            'post_id'=>'required',
            'title'=>'required',
            'content'=>'required',
            'tags'=>'required'
        ]);

        $post=Post::find(decrypt($request->post_id));

        if(Auth::user()==$post->user)
        {
        $post->title=$request->title;
        $post->content=$request->content;
        $post->slug=str_slug($request->title);

        $post->save();

        $post->tags()->attach($request->tags);

        Session::flash('success','Posted successfully');

        return redirect()->route('post.view',['id'=>encrypt($post->id)]);
        }
        else
        {
        Session::flash('error','Invalid request');
        return redirect()->back();

        }
    }
    public function viewPost($enc_id)
    {
    	$id=decrypt($enc_id);
    	$post=Post::find($id);
    	return view('post.view')->with('post',$post);
    }
    public function filter($enc_id)
    {
    	$id=decrypt($enc_id);
    	$tag=Tag::find($id);

    	$posts=$tag->posts;

    	$popular_tags = DB::table('post_tag')
                     ->select(DB::raw('count(tag_id) as repetition, tag_id'))
                     ->groupBy('tag_id')
                     ->orderBy('repetition', 'desc')
                     ->get();
        

    	return view('post.filtered_posts')->with('posts',$tag->posts->paginate(5))
    		->with('tag',$tag)
    		->with('tags',Tag::all())
    		->with('popular_tags',$popular_tags);

    }
    public function comment($post_id,Request $request)
    {
    	$this->validate($request,[
    		'content'=>'required'
    	]);

    	$comment=New Comment;

    	$comment->user_id=Auth::id();
    	$comment->post_id=decrypt($post_id);
    	$comment->content=$request->content;
    	$comment->save();

    	return redirect()->back();
    }

    public function delete(Request $request)
    {
        $post_id=decrypt($request->id);
        $post=Post::find($post_id);

        if(Auth::user()==$post->user||Auth::user()->admin())
        {

            $post->delete();
            return redirect()->route('home');
        }

        Session::flash('error','Invalid request');

        return redirect()->back();
    }
}
