<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class NotificationController extends Controller
{
 
    public function index(){
        $notifications=Notification::all();
        return view("admin.notification.index",compact('notifications'));
    }
    public function showForm(){
        return view ('admin.notification.create');
    }
     public function store(Request $request)
    {
        // 1️⃣ Validate request
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'to' => 'required|in:teacher,student,general',
            'path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Max 2MB
        ]);

        // 2️⃣ Handle file upload if provided
        if ($request->hasFile('path')) {
            $validated['path'] = $request->file('path')->store('notifications', 'public');
        }

        // 3️⃣ Store in DB
        Notification::create($validated);

        // 4️⃣ Redirect with success message
        return redirect()
            ->route('admin.notification.form')
            ->with('success', 'Notification published successfully.');
    }
    public function edit($id){
        $notification=Notification::findOrFail($id);
        return view('admin.notification.edit',compact('notification'));
    }
   

public function update(Request $request, $id)
{
    // 1️⃣ Find the notification
    $notification = Notification::findOrFail($id);

    // 2️⃣ Validate input
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'to' => 'required|in:teacher,student,general',
        'path' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // 3️⃣ If a new photo is uploaded
    if ($request->hasFile('path')) {

        // 🔹 Delete old photo if exists
        if ($notification->path && Storage::disk('public')->exists($notification->path)) {
            Storage::disk('public')->delete($notification->path);
        }

        // 🔹 Store new photo
        $validated['path'] = $request->file('path')->store('notifications', 'public');
    }

    // 4️⃣ Update database
    $notification->update($validated);

    // 5️⃣ Redirect with success message
    return redirect()
        ->route('admin.notification.form')
        ->with('success', 'Notification updated successfully.');
}

    public function delete($id){
       $notification = Notification::findOrFail($id);

    // 2️⃣ Delete the photo if it exists
    if ($notification->path && Storage::disk('public')->exists($notification->path)) {
        Storage::disk('public')->delete($notification->path);
    }

    // 3️⃣ Delete the notification from the database
    $notification->delete();

    // 4️⃣ Redirect with success message
    return redirect()
        ->route('admin.notification.form')
        ->with('success', 'Notification deleted successfully.');
    }
}
