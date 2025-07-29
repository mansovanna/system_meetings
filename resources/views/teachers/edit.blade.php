@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>✏️ កែប្រែក្នុងគ្រូ</h4>
    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>ឈ្មោះ</label>
            <input type="text" name="name" class="form-control" value="{{ $teacher->name }}" required>
        </div>
        <div class="mb-3">
            <label>អ៊ីមែល</label>
            <input type="email" name="email" class="form-control" value="{{ $teacher->email }}" required>
        </div>
        <div class="mb-3">
            <label>លេខទូរស័ព្ទ</label>
            <input type="text" name="phone" class="form-control" value="{{ $teacher->phone }}" required>
        </div>
        <div class="mb-3">
            <label>អំពីគ្រូ</label>
            <textarea name="description" class="form-control">{{ $teacher->description }}</textarea>
        </div>
        <button class="btn btn-warning">ធ្វើបច្ចុប្បន្នភាព</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">បោះបង់</a>
    </form>
</div>
@endsection
