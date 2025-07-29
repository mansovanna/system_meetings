@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <h3>➕ បន្ថែមគ្រូថ្មី</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ឈ្មោះគ្រូ</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">អ៊ីម៉ែល (ស្រេចចិត្ត)</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">លេខទូរស័ព្ទ (ស្រេចចិត្ត)</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">💾 រក្សាទុក</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary">↩ ត្រឡប់ក្រោយ</a>
    </form>
</div>
@endsection
