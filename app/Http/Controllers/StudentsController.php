<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ClassModel;
use App\Models\Notification;
use App\Models\Folder;

class StudentsController extends Controller
{
    // Show student dashboard
    public function dashboard()
    {
        $student = Auth::user();

        // You can pass any needed data to the dashboard view here
        return view('student.dashboard', compact('student'));
    }
    public function showRoutine(){
        $classes = ClassModel::with(['routines.subject', 'routines.teacher'])
                ->orderBy('name')
                ->get();

    // Define max periods to display (for example, 8)
    $maxPeriods = 5;

    return view('student.routine',compact(['classes','maxPeriods']));

    }
    public function notices()
{
    // Fetch notices for students: either general or role = 'student'
    // Adjust the query as per your Notice table structure

    $notices = Notification::where(function ($query) {
        $query->where('to', 'student')
              ->orWhere('to', 'general');
    })
    ->orderBy('created_at', 'desc')
    ->paginate(10); // paginate 10 per page

    return view("student.notice",compact('notices'));
}

    public function sharedFile()
    {
        // Get all folders with their related files
        $folders = Folder::with('files')->get();

        // Return view (adjust path as per your views structure)
        return view('student.shared', compact('folders'));
    }
}

