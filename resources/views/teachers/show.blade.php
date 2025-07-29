@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h4>🔍 ព័ត៌មានលម្អិត</h4>
    <ul class="list-group">
        <li class="list-group-item"><strong>ឈ្មោះ:</strong> {{ $teacher->name }}</li>
        <li class="list-group-item"><strong>អ៊ីមែល:</strong> {{ $teacher->email }}</li>
        <li class="list-group-item"><strong>លេខទូរស័ព្ទ:</strong> {{ $teacher->phone }}</li>
        <li class="list-group-item"><strong>អំពីគ្រូ:</strong> {{ $teacher->description }}</li>
    </ul>
    <a href="{{ route('teachers.index') }}" class="btn btn-secondary mt-3">ត្រឡប់ក្រោយ</a>
</div>
@endsection
