<?php

use App\Models\Meeting;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TeacherController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('meetings', MeetingController::class);
Route::resource('teachers', TeacherController::class);


Route::get('/', function () {
     $meetings = Meeting::with('teachers')->orderBy('date', 'desc')->get();
    return view('index', compact('meetings'));
});
