<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Folder;

class FolderController extends Controller
{
    public function index()
    {
        $folders = Folder::where('teacher_id', auth()->id())->get();
        return view('folders.index', compact('folders'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);

        Folder::create([
            'teacher_id' => auth()->user()->id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Folder created successfully!');
    }
}
