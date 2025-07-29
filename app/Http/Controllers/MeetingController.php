<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use App\Models\Teacher;
use App\Notifications\MeetingInviteNotification;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function store(Request $request)
    {
        $meeting = Meeting::create($request->only([
            'title', 'description', 'location', 'date', 'start_time', 'end_time'
        ]));

        // Attach teachers to meeting and send notifications
        if ($request->has('teacher_ids')) {
            foreach ($request->teacher_ids as $teacher_id) {
                $meeting->teachers()->attach($teacher_id);

                // Create notification in DB
                Notification::create([
                    'teacher_id' => $teacher_id,
                    'meeting_id' => $meeting->id,
                    'message' => 'You have been invited to a new meeting: ' . $meeting->title,
                ]);

                // Send email notification
                $teacher = Teacher::find($teacher_id);
                if ($teacher && $teacher->email) {
                    \Illuminate\Support\Facades\Notification::route('mail', $teacher->email)
                        ->notify(new MeetingInviteNotification($meeting));
                }
            }
        }

        return response()->json(['message' => 'Meeting created successfully.']);
    }
}
