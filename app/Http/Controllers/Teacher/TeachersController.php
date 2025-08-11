<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;

use App\Models\Routine;
use App\Models\User;
use App\Models\ClassModel;
use App\Models\Notification;


use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(){
        return view('teacher.dashboard');
    }

    public function myRoutine(){
        $routines=Routine::where('teacher_id',auth()->user()->id)->orderBy('period')->get();
        return view('teacher.routine',compact("routines"));
    }
    public function myNotice(){
        $notices=Notification::where('to',"general")->orWhere('to',"teacher")->get();
        return view("teacher.notices",compact('notices'));
    }

public function attendanceForm()
{
    $teacherId = auth()->user()->id;

    // Get distinct classes this teacher teaches
    $classIds = Routine::where('teacher_id', $teacherId)
        ->distinct()
        ->pluck('class_id');

    $classes = ClassModel::whereIn('id', $classIds)->get();

    return view('teacher.attendance-form', compact('classes'));
}

public function getStudentsByClass($classId)
{
    $teacherId = auth()->user()->id;

    // Check if teacher teaches this class
    $teachesClass = Routine::where('teacher_id', $teacherId)
        ->where('class_id', $classId)
        ->exists();

    if (!$teachesClass) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $students = User::where('class_id', $classId)->get();
    return response()->json("hello world");
}
 public function showMarkForm($classId)
    {
        $teacherId = auth()->user()->id();

        // Make sure the teacher actually teaches this class
        $class = ClassModel::whereHas('routines', function ($query) use ($teacherId) {
                $query->where('teacher_id', $teacherId);
            })
            ->where('id', $classId)
            ->firstOrFail();

        // Get all students in that class
        $students = User::where('class_id', $class->id)->where('role',"student")
            ->orderBy('id')
            ->get();

        return view('attendance.mark', compact('class', 'students'));
    }
}
