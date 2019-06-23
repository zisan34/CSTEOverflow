<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use Auth;
use App\Tag;
use App\User;

use Session;

class PostsController extends Controller
{
    //
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
    public function viewPost($slug,$enc_id)
    {
    	$id=decrypt($enc_id);
    	$post=Post::find($id);
    	return view('post.view')->with('post',$post);
    }
}
