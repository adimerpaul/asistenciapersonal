<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function asistencia(){
        return $this->hasMany(Asistencia::class)->whereDate('created_at',now());
    }
}
