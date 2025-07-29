<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

     protected $fillable = [
        'title', 'description', 'start_date', 'end_date', 'start_time', 'end_time', 'location'
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class);
    }
}
