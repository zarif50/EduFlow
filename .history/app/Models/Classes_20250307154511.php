<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classes extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];

    // Define the relationship to AssignTeacherToClass model
    public function assignTeachers()
    {
        return $this->hasMany(AssignTeacherToClass::class);
    }
}
