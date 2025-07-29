<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone'];

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class)->withPivot('status')->withTimestamps();
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }



}
