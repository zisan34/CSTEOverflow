<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\User;

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
        return view('admin.courses')->with('courses',$courses);
    }
    public function addCourse(Request $request)
    {
        $this->validate($request,[
            'title'=>'required'
        ]);

        $course=new Course;

        $course->title=$request->title;
        $course->code=$request->code;

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
