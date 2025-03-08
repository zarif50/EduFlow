<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'status'
        
    ];
    Subject::create([
        'name' => $request->name,
        'type' => $request->type,
        'status' => $request->status ?? 'active',  // Force default
    ]);
    
}
