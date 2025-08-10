<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index(){
        $students=User::where('role',"student")->get();

        return view("admin.students.index",compact('students'));        
    }
    public function create(){
        return view ('admin.students.create');
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
            'role'=>"student"
        ]);
        return redirect()->route('admin.students')->with('success',"created successfully");
    }
    public function edit($id){
         $student=User::findOrFail($id);
         return view('admin.students.edit',compact('student'));
    }

    public function update(Request $request, $id){
    $student = User::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $student->id,
        'password' => 'nullable|string|min:6',
    ]);

    $student->name = $validated['name'];
    $student->email = $validated['email'];

    if (!empty($validated['password'])) {
        $student->password = bcrypt($validated['password']);
    }

    $student->save();

    return redirect()->route('admin.students')->with('success', 'Student updated successfully.');
}
public function delete($id){

    $user=User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.students');

}


}
