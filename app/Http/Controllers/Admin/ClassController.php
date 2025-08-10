<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function index(){
        $classes=ClassModel::get();
         return view("admin.classes.index",compact('classes')); 
        
    }
    public function create(){
        return view ('admin.classes.create');
    }
    public function store(Request $request){
        $validData=Validator::make($request->all(),[
            'name'=>"string",  
        ]);
        if($validData->fails()){
            return redirect()->back()->withInput();
        }
        ClassModel::create([
            'name'=>$request->name,
        ]);
        return redirect()->route('admin.classes.show')->with('success',"created successfully");
    }
    public function edit($id){
         $class=ClassModel::findOrFail($id);
         return view('admin.classes.edit',compact('class'));
    }

    public function update(Request $request, $id){
    $class = ClassModel::findOrFail($id);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $class->name = $validated['name'];
   
    $class->save();

    return redirect()->route('admin.classes.show')->with('success', 'Student updated successfully.');
}
public function delete($id){

    $class=ClassModel::findOrFail($id);
    $class->delete();

    return redirect()->route('admin.classes.show');

}
}
