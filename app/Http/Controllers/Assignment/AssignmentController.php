<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use App\Models\StudentAssignment;
use Illuminate\Http\Request;
use App\Models\Assignment;

class AssignmentController extends Controller
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
            'title' => 'required',
            'due_date' => 'required',
            'course' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }
        

        //if duedate is less than today date
        if (strtotime($request->due_date) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('warning', 'Due date cannot be less than today date');
        }

        $assignment = new Assignment();
        $assignment->title = $request->title;
        $assignment->due_date = $request->due_date;
        $assignment->course_id = $request->course;
        $assignment->created_by = auth()->user()->id;
        $assignment->save();

        //upload file
        if ($request->hasFile('file')) {
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $fileName = str_replace(' ', '', $fileName);
            $path = $request->file('file')->storeAs('assignment', $fileName, 'public');
            $assignment->file = $path;
            $assignment->save();
        }


        return redirect()->back()->with('success', 'Assignment added successfully');
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
        $assignment = Assignment::findOrFail($id);
        $assignment->delete();
        return redirect()->back()->with('success', 'Assignment deleted successfully');
    }

    public function download($id)
    {
        $assignment = Assignment::findOrFail($id);
        return response()->download(storage_path('app/public/' . $assignment->file));
    }

    public function upload(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'file' => 'required',
        ]);

        $assignment = Assignment::findOrFail($request->assignment_id);

        //if duedate is less than today date
        if (strtotime($assignment->due_date) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('warning', 'Due date for this assignment has passed');
        }

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $studentAssignment = new StudentAssignment();
        $studentAssignment->assignment_id = $request->assignment_id;
        $studentAssignment->student_id = auth()->user()->id;
        $studentAssignment->save();

        //upload file
        if ($request->hasFile('file')) {
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $fileName = str_replace(' ', '', $fileName);
            $path = $request->file('file')->storeAs('assignment', $fileName, 'public');
            $studentAssignment->file = $path;
            $studentAssignment->save();
        }

        return redirect()->back()->with('success', 'Assignment uploaded successfully');
    }

    public function downloadstudentassignment($id)
    {
        $studentAssignment = StudentAssignment::findOrFail($id);
        return response()->download(storage_path('app/public/' . $studentAssignment->file));
    }
}
