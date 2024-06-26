<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\CourseStudent;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->get();
        return view('menu.user_management.users.list', compact('users'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('menu.user_management.users.add', compact('roles'));
    }
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        if ($request->role != 'Select Role') {
            $user->assignRole($request->role);
        }
        return redirect()->back()->with('success', 'User Added Successfully');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $roles = Role::all();
        return view('menu.user_management.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $this->validate($request, [
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => $request->usertype,
        ]);
        if ($request->role != 'Select Role') {
            $user->syncRoles($request->role);
        }
        return redirect()->back()->with('success', 'User Updated Successfully');
    }

    public function destroy($id)
    {
        $id = decrypt($id);
        User::find($id)->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    }

    public function getStudents()
    {
        if (Auth::user()->hasRole('Teacher')) {
            $users = [];
            $allcourses = Course::where('teacher_id', Auth::user()->id)->get();
            foreach ($allcourses as $course) {
                $courseStudent = CourseStudent::where('course_id', $course->id)->get();
            }
            foreach ($courseStudent as $student) {
                $users = User::where('id', $student->student_id)->get();
            }
        } else {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', 'Student');
            })->get();
        }

        return view('menu.students.list', compact('users'));
    }

    public function getTeachers()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', 'Teacher');
        })->get();
        return view('menu.teachers.list', compact('users'));
    }
}
