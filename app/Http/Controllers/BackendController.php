<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\User;
use App\Tag;
use App\Post;
use App\Semester;
use App\File;
use App\Notice;

use Session;
class BackendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.dashboard');
    }
    public function courses()
    {
        $courses=Course::all();
        return view('admin.courses')->with('semesters',Semester::all())
                                    ->with('courses',$courses);
    }
    public function addCourse(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'semester'=>'required',
            'code'=>'required'
        ]);

        if(!Semester::find($request->semester))
        {
            session::flash('error','Invalid Semester');
            return redirect()->back();
        }

        $course=new Course;

        $course->title=$request->title;
        $course->code=$request->code;
        $course->semester_id=$request->semester;

        $course->save();

        return redirect()->back();


    }
    public function deleteCourse($id)
    {
        $course=Course::find($id);
        if($course)
        {
            $course->delete();
            return redirect()->back();

        }
        return redirect()->back();
    }



    public function tags()
    {
        $tags=Tag::all();
        return view('admin.tags')->with('tags',$tags);
    }
    public function addTag(Request $request)
    {
        $this->validate($request,[
            'title'=>'required'
        ]);

        $tag=new Tag;
        $tag->title=$request->title;
        $tag->save();

        return redirect()->back();
    }
    public function deleteTag($id)
    {
        $tag=Tag::find($id);
        if($tag)
        {
            $tag->delete();
            return redirect()->back();

        }
        return redirect()->back();
    }

    public function posts()
    {
        return view('admin.posts')->with('posts',Post::all());
    }

    public function deletePost($id)
    {
        $post=Post::find($id);

        $post->delete();

        return redirect()->back();
    }

    public function trashedPosts()
    {
        $posts=Post::onlyTrashed()->get();


        return view('admin.trashedPosts')->with('posts',$posts);
    }

    public function destroyPost($id)
    {
        $post=Post::withTrashed()
                ->where('id', $id);

        $post->forceDelete();
        return redirect()->back();
    }
    public function restorePost($id)
    {
        $post=Post::withTrashed()
                ->where('id', $id)
                ->restore();

        return redirect()->back();
    }




    public function files()
    {
        
        $semesters=Semester::all();
        return view('admin.files')
                                ->with('semesters',$semesters);
    }
    public function deleteFile($id)
    {
        $file=File::find($id);

        $file->delete();

        return redirect()->back();
    }



    public function notices()
    {
        $notices=Notice::all();
        return view('admin.notices')->with('notices',$notices);
    }
    public function deleteNotice($id)
    {
        $notice=Notice::find($id);

        $notice->delete();

        return redirect()->back();
    }




    public function users()
    {
        $users=User::all();
        return view('admin.users')->with('users',$users);

    }
    public function enableUser($id)
    {
        $user=User::find($id);

        $user->enabled="1";
        $user->save();
        return redirect()->back();
    }
    public function disableUser($id)
    {
        
        $user=User::find($id);

        $user->enabled="0";
        $user->save();
        return redirect()->back();
    }
    public function deleteUser($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->back();
    }
}
