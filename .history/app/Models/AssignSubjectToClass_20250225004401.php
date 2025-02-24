<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignSubjectToClass extends Model
{
    use HasFactory;
    protected $fillable = [
        'class_id','subject_id'
        
    ];
}
