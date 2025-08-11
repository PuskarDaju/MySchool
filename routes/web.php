<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Teacher\TeachersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\StudentsController;


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/', function () {
    return view('welcome');
});

Route::controller(AdminController::class)->group(function(){
    Route::get("/dashboard",'index')->name("dashboard");
});

Route::controller(StudentController::class)->group(function(){
    Route::get("/showstundents",'index')->name("admin.students");
    Route::get("/create_students",'create')->name("admin.students.create");
    Route::post('/students/store','store')->name("admin.students.store");
    Route::get('/students/edit/{id}','edit')->name("admin.students.edit");
    Route::put('/students/Update/{id}','update')->name("admin.students.update");
    Route::delete('/students/delete/{id}','delete')->name("admin.students.delete");
});

Route::prefix('/subjects')->group(function(){
Route::controller(SubjectController::class)->group(function(){
    Route::get('/show','index')->name("admin.subjects.show");
    Route::get("/create",'create')->name("admin.subjects.create");
    Route::post('/store','store')->name("admin.subjects.store");
    Route::get('/edit/{id}','edit')->name("admin.subjects.edit");
    Route::put('/Update/{id}','update')->name("admin.subjects.update");
    Route::delete('/delete/{id}','delete')->name("admin.subjects.delete");
    });

});

Route::prefix('/teahcers')->group(function(){
Route::controller(TeacherController::class)->group(function(){
    Route::Post('/{id}/assign_subjects','assignSubjects')->name("admin.teachers.assignSubjects");
    Route::get('/assign/subjects/{id}','showAssign')->name("admin.assign.subjects.show");
    Route::get('/show/assign/subjects/{id}','showAssignedSubjects')->name("admin.show.subjects.assign");
    Route::get('/show','index')->name("admin.teachers.show");
    Route::get("/create",'create')->name("admin.teachers.create");
    Route::post('/store','store')->name("admin.teachers.store");
    Route::get('/edit/{id}','edit')->name("admin.teachers.edit");
    Route::put('/Update/{id}','update')->name("admin.teachers.update");
    Route::delete('/delete/{id}','delete')->name("admin.teachers.delete");
    });
});
Route::prefix('/classes')->group(function(){
Route::controller(ClassController::class)->group(function(){
    Route::get('/show','index')->name("admin.classes.show");
    Route::get("/create",'create')->name("admin.classes.create");
    Route::post('/store','store')->name("admin.classes.store");
    Route::get('/edit/{id}','edit')->name("admin.classes.edit");
    Route::put('/Update/{id}','update')->name("admin.classes.update");
    Route::delete('/delete/{id}','delete')->name("admin.classes.delete");
    });
});

Route::prefix("/notification")->group(function(){
Route::controller(NotificationController::class)->group(function(){
    Route::get('/create','index')->name('admin.notification.form');
    Route::get('/show','showForm')->name('admin.notification.create');
    Route::get('/edit/{id}','edit')->name('admin.notification.edit');
    ROute::put("/update/{id}",'update')->name('admin.notification.update');
    Route::delete('/delete/{id}','delete')->name('admin.notification.delete');
    Route::post('/store','store')->name('admin.notification.store');

});
});

Route::prefix("/routine")->group(function(){
Route::controller(RoutineController::class)->group(function(){
    Route::get('/index','index')->name('routine.index');
    Route::get('/routine/create/{class}','create')->name('routine.create');
Route::post('/routine/save/{class}', 'save')->name('routine.save');
});
});

Route::prefix('/teachers')->group(function(){
    Route::controller(TeachersController::class)->group(function(){
        Route::get('/dashboard','index')->name('teacher.dashboard');
        Route::get("/routine","myRoutine")->name("teacher.routine");
        Route::get("/notice","myNotice")->name("teacher.notice");
    });

     Route::get('/folders', [FolderController::class, 'index'])->name('folders.index');
    Route::post('/folders', [FolderController::class, 'store'])->name('folders.store');

    Route::post('/folders/{folder}/files', [FileController::class, 'store'])->name('files.store');
        Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');
  
});

 Route::prefix('/students')->group(function(){
     Route::get('/dashboard', [StudentsController::class, 'dashboard'])->name('student.dashboard');

    // Routine
    Route::get('/routine', [StudentsController::class, 'showRoutine'])->name('student.routine');

    // Notices
    Route::get('/notices', [StudentsController::class, 'notices'])->name('student.notices');

    // Shared Files
    Route::get('/files', [StudentsController::class, 'sharedFile'])->name('student.files');
 });