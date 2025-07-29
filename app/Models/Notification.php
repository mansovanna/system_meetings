<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'meeting_id', 'message', 'is_read'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }
}
