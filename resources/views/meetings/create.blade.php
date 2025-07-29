@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h3>➕ បន្ថែមកិច្ចប្រជុំថ្មី</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('meetings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">ចំណងជើង</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">អំពីកិច្ចប្រជុំ</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">ចាប់ផ្ដើមថ្ងៃ</label>
                <input type="date" name="start_date" class="form-control" required value="{{ old('start_date') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">បញ្ចប់ថ្ងៃ</label>
                <input type="date" name="end_date" class="form-control" required value="{{ old('end_date') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">ម៉ោងចាប់ផ្ដើម</label>
                <input type="time" name="start_time" class="form-control" required value="{{ old('start_time') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">ម៉ោងបញ្ចប់</label>
                <input type="time" name="end_time" class="form-control" required value="{{ old('end_time') }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">ទីតាំង</label>
            <input type="text" name="location" class="form-control" required value="{{ old('location') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">ជ្រើសរើសគ្រូចូលរួម</label>
            <select name="teacher_ids[]" class="form-select" multiple="multiple" required>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" @if(is_array(old('teacher_ids')) && in_array($teacher->id, old('teacher_ids'))) selected @endif>
                        {{ $teacher->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">អាចជ្រើសបានច្រើន។</small>
        </div>

        <button type="submit" class="btn btn-success">💾 រក្សាទុក</button>
        <a href="{{ route('meetings.index') }}" class="btn btn-secondary">↩ ត្រឡប់ក្រោយ</a>
    </form>
</div>
@endsection

@section('scripts')
<!-- JQuery ត្រូវមានដំបូង -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS និង JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('select[name="teacher_ids[]"]').select2({
            placeholder: "ជ្រើសរើសគ្រូចូលរួម",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
