<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();


        $students = User::whereHas('roles', function ($q) {
            $q->where('name', 'Student');
        })->get();
        return view('menu.course_management.list', compact('courses', 'students'));
    }

    public function create()
    {
        //get user have role teacher
        $teachers = User::whereHas('roles', function ($q) {
            $q->where('name', 'Teacher');
        })->get();
        return view('menu.course_management.add', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $course = new Course();
        $course->name = $request->name;
        $course->code = Str::random(6);
        $course->teacher_id = $request->teacher;
        $course->created_by = auth()->user()->id;
        $course->start_date = $request->startDate;
        $course->end_date = $request->endDate;
        $course->save();

        return redirect()->route('viewcourses')->with('success', 'Course added successfully');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        $students = User::whereHas('roles', function ($q) {
            $q->where('name', 'Student');
        })->get();
        return view('menu.course_management.show', compact('course', 'students'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $teachers = User::whereHas('roles', function ($q) {
            $q->where('name', 'Teacher');
        })->get();
        return view('menu.course_management.edit', compact('course', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'teacher' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->teacher_id = $request->teacher;
        $course->start_date = $request->startDate;
        $course->end_date = $request->endDate;
        $course->save();

        return redirect()->route('viewcourses')->with('success', 'Course updated successfully');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->back()->with('success', 'Course deleted successfully');
    }

    public function addStudentToCourse(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'course' => 'required',
            'student' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $courseStudent = new CourseStudent();
        //check if student already in course
        $check = CourseStudent::where('course_id', $request->course)->where('student_id', $request->student)->first();
        if ($check) {
            return redirect()->back()->with('warning', 'Student already in course');
        }
        $courseStudent->course_id = $request->course;
        $courseStudent->student_id = $request->student;
        $courseStudent->save();


        return redirect()->back()->with('success', 'Student added to course successfully');
    }
}
