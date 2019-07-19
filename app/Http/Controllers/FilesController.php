<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Semester;
use App\File;
use Auth;
use Session;

class FilesController extends Controller
{
    //
    public function index()
    {
    	$semesters=Semester::all();
    	return view('file.files')
    							->with('semesters',$semesters);
    }
    public function save(Request $request)
    {
    	# code...
    	$this->validate($request,[
    		'title'=>'required',
    		'semester_id'=>'required',
    		'link'=>'required|url'
    	]);

    	$file=new File;

    	$file->title=$request->title;
    	$file->semester_id=$request->semester_id;
    	$file->link=$request->link;
    	$file->user_id=Auth::id();

    	$file->save();

    	return redirect()->back();

    }
}
