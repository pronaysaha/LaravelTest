<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;

    public function department()
{
    return $this->belongsTo(Department::class);
}
public function achievements()
{
    return $this->belongsToMany(Achievement::class)->withPivot('achievement_date');
}
}
