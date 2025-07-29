{{-- resources/views/meetings/edit.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <h3>✏️ កែប្រែប្រជុំ</h3>

        <form action="{{ route('meetings.update', $meeting->id) }}" method="POST">
            @csrf
            @method('PUT')

            @php
                $startDate = old('start_date') ?? $meeting->start_date;
                $endDate = old('end_date') ?? $meeting->end_date;
                $startTime = old('start_time') ?? $meeting->start_time;
                $endTime = old('end_time') ?? $meeting->end_time;
            @endphp

            <div class="mb-3">
                <label for="title" class="form-label">ចំណងជើង</label>
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title', $meeting->title) }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">អំពីប្រជុំ</label>
                <textarea name="description" id="description" rows="3"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $meeting->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">ចាប់ផ្ដើមថ្ងៃ</label>
                    <input type="date" name="start_date" id="start_date"
                        class="form-control @error('start_date') is-invalid @enderror"
                        value="{{ \Carbon\Carbon::parse($startDate)->format('Y-m-d') }}" required>
                    @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">បញ្ចប់ថ្ងៃ</label>
                    <input type="date" name="end_date" id="end_date"
                        class="form-control @error('end_date') is-invalid @enderror"
                        value="{{ \Carbon\Carbon::parse($endDate)->format('Y-m-d') }}" required>
                    @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_time" class="form-label">ម៉ោងចាប់ផ្ដើម</label>
                    <input type="time" name="start_time" id="start_time"
                        class="form-control @error('start_time') is-invalid @enderror"
                        value="{{ \Carbon\Carbon::parse($startTime)->format('H:i') }}" required>
                    @error('start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="end_time" class="form-label">ម៉ោងបញ្ចប់</label>
                    <input type="time" name="end_time" id="end_time"
                        class="form-control @error('end_time') is-invalid @enderror"
                        value="{{ \Carbon\Carbon::parse($endTime)->format('H:i') }}" required>
                    @error('end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">ទីតាំង</label>
                <input type="text" name="location" id="location"
                    class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location', $meeting->location) }}" required>
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="teacher_ids" class="form-label">ជ្រើសរើសគ្រូចូលរួម</label>
                <select name="teacher_ids[]" id="teacher_ids" class="form-select @error('teacher_ids') is-invalid @enderror"
                    multiple required>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}"
                            {{ in_array($teacher->id, old('teacher_ids', $meeting->teachers->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $teacher->name }}
                        </option>
                    @endforeach
                </select>

                <small class="form-text text-muted">អាចជ្រើសបានច្រើន។</small>
                @error('teacher_ids')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">💾 រក្សាទុក</button>
            <a href="{{ route('meetings.index') }}" class="btn btn-secondary">↩ ត្រឡប់ក្រោយ</a>
        </form>
    </div>
@endsection
