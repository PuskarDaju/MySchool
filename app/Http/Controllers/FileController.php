<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;


class FileController extends Controller
{
    public function store(Request $request, $folderId)
    {
        $request->validate(['file' => 'required|file|max:2048']);

        $path = $request->file('file')->store('teacher_files', 'public');

        File::create([
            'folder_id' => $folderId,
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
            'type' => $request->file('file')->getClientMimeType(),
        ]);

        return back()->with('success', 'File uploaded successfully!');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return Storage::disk('public')->download($file->path, $file->name);
    }
}

