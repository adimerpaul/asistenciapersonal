<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    function persona(){
        return $this->belongsTo(Persona::class);
    }
    function logs(){
        return $this->hasMany(Log::class);
    }
}
