<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    protected $guarded=[];
    protected $table="classes";

    public function routines()
{
    return $this->hasMany(Routine::class, 'class_id');
}

}
