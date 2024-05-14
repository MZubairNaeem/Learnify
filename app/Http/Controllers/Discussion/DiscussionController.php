<?php

namespace App\Http\Controllers\Discussion;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'msg' => 'required',
            'course' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $discussion = new Discussion();
        $discussion->msg = $request->msg;
        $discussion->course_id = $request->course;
        $discussion->created_by = auth()->user()->id;
        $discussion->save();

        return redirect()->back()->with('success', 'Message sent successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $discussion = Discussion::find($id);
        $discussion->delete();
        return redirect()->back()->with('success', 'Discussion deleted successfully');
    }
}
