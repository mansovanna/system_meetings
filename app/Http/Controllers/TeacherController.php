<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Add your resource methods here as needed
    public function index()
    {
        $teachers = Teacher::all();
        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('teachers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
        ]);

        Teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'គ្រូត្រូវបានបញ្ចូលជោគជ័យ!');
    }



    public function show(Teacher $teacher)
    {
        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone' => 'required',
            'description' => 'nullable|string',
        ]);

        $teacher->update($request->all());

        return redirect()->route('teachers.index')->with('success', 'បានធ្វើបច្ចុប្បន្នភាព!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'បានលុបជោគជ័យ!');
    }
}
