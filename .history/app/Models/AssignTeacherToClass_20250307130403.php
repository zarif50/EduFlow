<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTeacherToClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id','subject_id','teacher_id'

    ];
    classes id assign_teacher class
    public function class()
    {
        return $this->belongsTo(Classes::class,'class_id');
    }
}
