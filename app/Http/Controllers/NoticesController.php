<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notice;

use Auth;

use Session;

class NoticesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $notices=Notice::orderByDesc('created_at')->get();

        return view('notice.notices')
                                    ->with('notices',$notices);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('notice.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        //
        $this->validate($request,[
            'title'=>'required',
            'content'=>'required|mimes:pdf|max:10000',
            'type'=>'required'
            ]);
        $notice=new Notice;
        $notice->title=$request->title;
        $notice->user_id=Auth::id();
        $notice->comment=$request->comment;
        $notice->type=$request->type;


        $file=$request->content;
        $file_new_name=time().'_'.$request->user_id.'_'.$file->getClientOriginalName();

        $notice->content='/uploads/notice/'.$file_new_name;

        $file->move('uploads/notice',$file_new_name);

        $notice->save();

        Session::flash('success','Notice Published Successfully');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        //
        $notice_id=decrypt($id);

        $notice=Notice::find($notice_id);

        return view('notice.view')->with('notice',$notice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
