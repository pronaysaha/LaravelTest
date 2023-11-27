<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class achievements extends Model
{
    use HasFactory;
    public function employees()
{
    return $this->belongsToMany(Employee::class)->withPivot('achievement_date');
}

   
}
