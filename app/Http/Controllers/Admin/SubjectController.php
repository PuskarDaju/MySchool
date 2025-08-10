<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(){
        $students=Subject::get();
         return view("admin.subjects.index",compact('students')); 
        
    }
    public function create(){
        return view ('admin.subjects.create');
    }
    public function store(Request $request){
        $validData=Validator::make($request->all(),[
            'name'=>"string",  
        ]);
        if($validData->fails()){
            return redirect()->back();
        }
        Subject::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('admin.subjects.show')->with('success',"created successfully");
    }
    public function edit($id){
         $student=Subject::findOrFail($id);
         return view('admin.subjects.edit',compact('student'));
    }

    public function update(Request $request, $id){
    $subject = Subject::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $subject->name = $validated['name'];
   
    $subject->save();

    return redirect()->route('admin.subjects.show')->with('success', 'Student updated successfully.');
}
public function delete($id){

    $subject=Subject::findOrFail($id);
    $subject->delete();

    return redirect()->route('admin.subjects.show');

}


}
