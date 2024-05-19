<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\Material;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\Assignment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        if (Auth::user()->hasRole('Super Admin')) {
            $assignmentCount = Assignment::count();
            $studentCount = User::whereHas('roles', function ($q) {
                $q->where('name', 'student');
            })->count();
            $teacherCount = User::whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })->count();
            $courseCount = Course::count();
        } else if (Auth::user()->hasRole('Teacher')) {
            $assignmentCount = Assignment::where('created_by', Auth::user()->id)->count();
            $studentCount = 0;
            $allcourses = Course::where('teacher_id', Auth::user()->id)->get();
            $courseStudent = collect(); // Initialize $courseStudent as an empty collection

            if ($allcourses->count() > 0) {
                foreach ($allcourses as $course) {
                    $courseStudents = CourseStudent::where('course_id', $course->id)->get();
                    $courseStudent = $courseStudent->merge($courseStudents); // Merge course students into $courseStudent collection
                }
            }

            if ($courseStudent->count() > 0) {
                foreach ($courseStudent as $student) {
                    $studentCount += User::where('id', $student->student_id)->count(); // Increment $studentCount for each user found
                }
            }

            $teacherCount = User::whereHas('roles', function ($q) {
                $q->where('name', 'teacher');
            })->count();
            $courseCount = Course::where('created_by', Auth::user()->id)->count();
        } else if (Auth::user()->hasRole('Student')) {
            $studentCount = 0;
            $teacherCount = 0;
            $courseStudent = CourseStudent::where('student_id', Auth::user()->id)->get();
            $courseCount = Course::whereIn('id', $courseStudent->pluck('course_id'))->count();


            $assignmentCount = Assignment::whereIn('course_id', $courseStudent->pluck('course_id'))->count();
        } else {
            $assignmentCount = 0;
            $studentCount = 0;
            $teacherCount = 0;
            $courseCount = 0;
        }


        if (Auth::user()->hasRole('Super Admin')) {
            $users = User::where('id', '!=', '1')->latest()->take(5)->get();
            $courses = Course::latest()->take(5)->get();
            $assignments = Assignment::latest()->take(5)->get();
            $materials = Material::latest()->take(5)->get();
        } else if (Auth::user()->hasRole('Teacher')) {
            //get those users who are in the same course created by the teacher
            $users = [];
            $allcourses = Course::where('teacher_id', Auth::user()->id)->get();
            foreach ($allcourses as $course) {
                $courseStudent = CourseStudent::where('course_id', $course->id)->get();
            }
            foreach ($courseStudent as $student) {
                $users = User::where('id', $student->student_id)->get();
            }



            $courses = Course::where('created_by', Auth::user()->id)->latest()->take(5)->get();
            $assignments = Assignment::where('created_by', Auth::user()->id)->latest()->take(5)->get();
            $materials = Material::where('created_by', Auth::user()->id)->latest()->take(5)->get();
        } else if (Auth::user()->hasRole('Student')) {
            $users = [];
            //get those courses in which the student is enrolled
            $courseStudent = CourseStudent::where('student_id', Auth::user()->id)->get();
            $courses = Course::whereIn('id', $courseStudent->pluck('course_id'))->get();

            $assignments = Assignment::whereIn('course_id', $courseStudent->pluck('course_id'))->get();

            $materials = Material::whereIn('course_id', $courseStudent->pluck('course_id'))->get();


        } else {
            $users = [];
            $courses = [];
            $assignments = [];
            $materials = [];
        }
        return view('index', compact('assignmentCount', 'studentCount', 'teacherCount', 'courseCount', 'users', 'courses', 'assignments', 'materials'));
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->usertype = $request->get('usertype');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar = $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            return response()->json([
                'isSuccess' => false,
                'Message' => "Your Current password does not matches with the password you provided. Please try again."
            ], 200); // Status code
        } else {
            $user = User::find($id);
            $user->password = Hash::make($request->get('password'));
            $user->update();
            if ($user) {
                Session::flash('message', 'Password updated successfully!');
                Session::flash('alert-class', 'alert-success');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Password updated successfully!"
                ], 200); // Status code here
            } else {
                Session::flash('message', 'Something went wrong!');
                Session::flash('alert-class', 'alert-danger');
                return response()->json([
                    'isSuccess' => true,
                    'Message' => "Something went wrong!"
                ], 200); // Status code here
            }
        }
    }
}
