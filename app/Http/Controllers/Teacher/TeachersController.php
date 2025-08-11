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
}
