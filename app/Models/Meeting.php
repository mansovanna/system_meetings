<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'location', 'date', 'start_time', 'end_time'];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withPivot('status')->withTimestamps();
    }
}
