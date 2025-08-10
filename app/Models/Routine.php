<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $fillable = [
        'class_id',
        'period',
        'subject_id',
        'teacher_id',
    ];

    // Relationships

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
