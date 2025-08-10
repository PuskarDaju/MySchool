<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded =[];

    public function user(){
       return $this->belongsTo(User::class,'teacher_id');
    }
    public function subject(){
       return $this->belongsToMany(Subject::class,"teachers","subject_id");
    }
}
