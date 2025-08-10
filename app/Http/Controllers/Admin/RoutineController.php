<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Routine;
use App\Models\ClassModel;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class RoutineController extends Controller
{
public function index()
{
    $classes = ClassModel::with(['routines.subject', 'routines.teacher'])
                ->orderBy('name')
                ->get();

    // Define max periods to display (for example, 8)
    $maxPeriods = 5;

    return view('admin.routine.index', compact('classes', 'maxPeriods'));
}


public function create(ClassModel $class)
{
    $subjects = Subject::orderBy('name')->where('class_id',$class->id)->get();
    $teachers = User::where('role', 'teacher')->orderBy('name')->get();

    // Load existing routine for this class keyed by period
    $existingRoutine = Routine::where('class_id', $class->id)->get()->keyBy('period');

    // Load all busy teacher assignments (period => teacher ids) for *all classes* during the periods you're handling
    // For example, periods 1 to 5
    $periods = range(1, 5);

    $busyTeacherAssignments = Routine::whereIn('period', $periods)
                                    ->where('teacher_id', '!=', null)
                                    ->get()
                                    ->groupBy('period')
                                    ->map(function ($group) {
                                        return $group->pluck('teacher_id')->unique()->toArray();
                                    });

    // $busyTeacherAssignments is like:
    // [
    //   1 => [2,5],
    //   2 => [3,4,7],
    //   ...
    // ]

    return view('admin.routine.create', compact('class', 'subjects', 'teachers', 'existingRoutine', 'busyTeacherAssignments'));


}



public function save(Request $request, ClassModel $class)
{
    $maxPeriods = 8;

    $rules = [];
    for ($i = 1; $i <= $maxPeriods; $i++) {
        $rules["periods.$i.subject_id"] = 'nullable|exists:subjects,id';
        $rules["periods.$i.teacher_id"] = 'nullable|exists:users,id';
    }

    $validated = $request->validate($rules);

    foreach ($validated['periods'] as $period => $data) {
        if (($data['subject_id'] && !$data['teacher_id']) || (!$data['subject_id'] && $data['teacher_id'])) {
            return back()->withErrors("Both subject and teacher must be selected for period $period")->withInput();
        }
    }

    foreach ($validated['periods'] as $period => $data) {
        if ($data['teacher_id']) {
            $conflict = Routine::where('teacher_id', $data['teacher_id'])
                ->where('period', $period)
                ->where('class_id', '!=', $class->id)
                ->exists();

            if ($conflict) {
                return back()->withErrors("Teacher for period $period is already assigned to another class")->withInput();
            }
        }
    }

    foreach ($validated['periods'] as $period => $data) {
        if ($data['subject_id'] && $data['teacher_id']) {
            Routine::updateOrCreate(
                ['class_id' => $class->id, 'period' => $period],
                ['subject_id' => $data['subject_id'], 'teacher_id' => $data['teacher_id']]
            );
        } else {
            Routine::where('class_id', $class->id)->where('period', $period)->delete();
        }
    }

    return redirect()->route('routine.create', $class->id)->with('success', 'Routine saved successfully.');
}



}
