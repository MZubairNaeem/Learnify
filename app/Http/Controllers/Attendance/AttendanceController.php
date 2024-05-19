<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {

    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attendance = new Attendance();
        $attendance->course_id = $request->course;
        $attendance->created_by = auth()->user()->id;
        $attendance->date = date('Y-m-d');
        $attendance->time = date('H:i:s');
        $attendance->save();

        return redirect()->back()->with('success', 'Attendance taken successfully');
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
        $attendance = Attendance::find($id);
        $attendance->delete();
        return redirect()->back()->with('success', 'Attendance deleted successfully');
    }

    public function present($id)
    { //if student attendance is already taken
        if(StudentAttendance::where('attendance_id', $id)->where('student_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('warning', 'Attendance already taken');
        }
        $studentAttendance = new StudentAttendance();
        $studentAttendance->attendance_id = $id;
        $studentAttendance->student_id = auth()->user()->id;
        $studentAttendance->status = 'present';
        $studentAttendance->save();

        return redirect()->back()->with('success', 'Attendance taken successfully');
    }

    public function absent($id)
    {
        if(StudentAttendance::where('attendance_id', $id)->where('student_id', auth()->user()->id)->exists()){
            return redirect()->back()->with('warning', 'Attendance already taken');
        }
        $studentAttendance = new StudentAttendance();
        $studentAttendance->attendance_id = $id;
        $studentAttendance->student_id = auth()->user()->id;
        $studentAttendance->status = 'absent';
        $studentAttendance->save();

        return redirect()->back()->with('success', 'Attendance taken successfully');
    }
}
