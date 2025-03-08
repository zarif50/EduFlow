<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HA
    protected $fillable = [
        'name'
        
    ];
}
