<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Notification;
use App\Models\Teacher;
use App\Notifications\MeetingInviteNotification;
use Illuminate\Http\Request;

class MeetingController extends Controller
{

    public function index()
    {

        $meetings = Meeting::with('teachers')->latest()->get();


        return view('meetings.index', compact('meetings'));

        // return response()->json(
        //     [
        //         'message' => 'This is data!',
        //         'data' =>$meetings
        //     ]
        // );
    }

    // app/Http/Controllers/MeetingController.php

    public function create()
    {
        $teachers = Teacher::all(); // assuming you have a Teacher model
        return view('meetings.create', compact('teachers'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'location' => 'required|string|max:255',
            'teacher_ids' => 'required|array|min:1',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        // Create meeting record
        $meeting = Meeting::create($validated);

        // Attach all selected teachers at once
        $meeting->teachers()->attach($request->teacher_ids);

        // Loop through teachers to create notifications and send emails
        foreach ($request->teacher_ids as $teacher_id) {
            // Create notification in DB (assuming you have a Notification model with these fields)
            Notification::create([
                'teacher_id' => $teacher_id,
                'meeting_id' => $meeting->id,
                'message' => 'You have been invited to a new meeting: ' . $meeting->title,
            ]);

            // Send email notification
            // $teacher = Teacher::find($teacher_id);
            // if ($teacher && $teacher->email) {
            //     \Illuminate\Support\Facades\Notification::route('mail', $teacher->email)
            //         ->notify(new MeetingInviteNotification($meeting));
            // }
        }

        return redirect()->route('meetings.index')->with('success', 'បន្ថែមប្រជុំបានជោគជ័យ។');
    }


    public function edit($id)
    {
        $meeting = Meeting::with('teachers')->findOrFail($id);
        $teachers = Teacher::all();
        return view('meetings.edit', compact('meeting', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'location' => 'required|string|max:255',
            'teacher_ids' => 'required|array|min:1',
            'teacher_ids.*' => 'exists:teachers,id',
        ]);

        $meeting = Meeting::findOrFail($id);
        $meeting->update($validated);

        // Sync pivot table to add/remove teachers
        $meeting->teachers()->sync($request->teacher_ids);

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }


    public function destroy($id)
    {
        $meeting = Meeting::findOrFail($id);
        $meeting->delete();

        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully.');
    }


}
