<?php

namespace App\Http\Controllers\CourseManagement;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Discussion;
use App\Models\Material;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CourseController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            $courses = Course::all();
        } else if (Auth::user()->hasRole('Teacher')) {
            $courses = Course::where('teacher_id', Auth::user()->id)->get();
        } else if (Auth::user()->hasRole('Student')) {
            $courses = CourseStudent::where('student_id', Auth::user()->id)->get();
            $courses = $courses->map(function ($course) {
                return Course::find($course->course_id);
            });
        } else {
            $courses = Course::all();
        }
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
            'code' => 'required',
            'teacher' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        if (Course::where('code', $request->code)->exists()) {
            return redirect()->back()->with('warning', 'Course code already exists')->withInput();
        }

        $course = new Course();
        $course->name = $request->name;
        $course->code = $request->code;
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

        $assignments = Assignment::where('course_id', $id)->get();
        $materials = Material::where('course_id', $id)->get();
        $studentsInCourse = CourseStudent::where('course_id', $id)->get();
        $attendances = Attendance::where('course_id', $id)->get();
        $discussions = Discussion::with('user', 'course')->where('course_id', $id)->get();

        $isExpired = false;
        $today = date('Y-m-d');
        if ($course->end_date < $today) {
            $isExpired = true;
        }
        return view('menu.course_management.show', compact('course', 'students', 'assignments', 'materials', 'studentsInCourse', 'attendances', 'discussions', 'isExpired'));
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
            'code' => 'required',
            'teacher' => 'required',
            'startDate' => 'required',
            'endDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('warning', 'All fields are required')->withErrors($validator)->withInput();
        }

        $course = Course::findOrFail($id);
        $course->name = $request->name;
        $course->code = $request->code;
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

    public function removeStudentFromCourse(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'course' => 'required',
            'student' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $courseStudent = CourseStudent::where('course_id', $request->course)->where('student_id', $request->student)->first();
        $courseStudent->delete();

        return redirect()->back()->with('success', 'Student removed from course successfully');
    }

    public function enrollCourse(Request $request)
    {
        // dd($request->all());
        $validator = \Validator::make($request->all(), [
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $course = Course::where('code', $request->code)->first();

        $today = date('Y-m-d');
        if ($course->end_date < $today) {
            return redirect()->back()->with('warning', 'Course has expired');
        }

        $courseStudent = new CourseStudent();
        //check if student already in course
        $check = CourseStudent::where('course_id', $course->id)->where('student_id', Auth::user()->id)->first();
        if ($check) {
            return redirect()->back()->with('warning', 'You are already enrolled in this course');
        }
        $courseStudent->course_id = $course->id;
        $courseStudent->student_id = Auth::user()->id;
        $courseStudent->save();

        return redirect()->back()->with('success', 'Course enrolled successfully');
    }
}
