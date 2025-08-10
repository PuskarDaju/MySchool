<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index(){
        $students=User::where('role',"teacher")->get();

        return view("admin.teachers.index",compact('students'));        
    }
    public function create(){
        return view ('admin.teachers.create');
    }
    public function store(Request $request){
        $validData=Validator::make($request->all(),[
            'name'=>"string",
            'email'=>"required|email",
            "password"=>"min:6|string"

        ]);
        if($validData->fails()){
            return redirect()->back();
        }
       User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password,
            'role'=>"teacher"
        ]);


        return redirect()->route('admin.teachers.show')->with('success',"created successfully");
    }
    public function edit($id){
         $student=User::findOrFail($id);
         return view('admin.teachers.edit',compact('student'));
    }

    public function update(Request $request, $id){
    $teacher = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $teacher->id,
        'password' => 'nullable|string|min:6',
    ]);

    $teacher->name = $validated['name'];
    $teacher->email = $validated['email'];

    if (!empty($validated['password'])) {
        $teacher->password = bcrypt($validated['password']);
    }

    $teacher->save();

    return redirect()->route('admin.teachers.show')->with('success', 'Student updated successfully.');
}

public function delete($id){

    $user=User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.teachers.show');

}
public function showAssign($id){
    $teacher=User::where('id',$id)->first();
    $subjects=Subject::get();
    return view('admin.teachers.assign',compact(['subjects','teacher']));

}

public function assignSubjects(Request $request,$id){
 $sub_names=$request->input('subject_ids'); 
    foreach($sub_names as $sub){
        Teacher::create([
            "teacher_id"=>$id,
            "subject_id"=>$sub
        ]);
    }

    return redirect()->route('admin.teachers.show');

}

public function showAssignedSubjects($userId){
      $teacher = Teacher::with("user",'subject')->find($userId);
      $subids=Teacher::where('teacher_id',$userId)->pluck('subject_id');

  
      $assignedSubjects=[];
      foreach($subids as $sub_id){
       $assignedSubjects[] = Subject::where('id', $sub_id)->value('name');

      }

    


    return view('admin.teachers.show_assign_subjects', compact('teacher', 'assignedSubjects'));

}


}
