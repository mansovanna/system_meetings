@extends('layouts.app') {{-- assuming you have a layout file --}}
@section('content')

    <div class="container-fluid"> {{-- changed from container to container-fluid --}}
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">👩‍🏫បញ្ជីគ្រូ</h4>
                <a href="{{ route('teachers.create') }}" class="btn btn-light btn-sm">
                    ➕ បន្ថែមគ្រូថ្មី
                </a>
            </div>
            <div class="card-body p-0">
                @if (!empty($teachers) && count($teachers))
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-secondary text-center">
                                <tr>
                                    <th>#</th>
                                    <th>ឈ្មោះ</th>
                                    <th>អ៊ីមែល</th>
                                    <th>លេខទូរស័ព្ទ</th>
                                    <th>អំពីគ្រូ</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($teachers as $index => $teacher)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $teacher->name }}</td>
                                        <td>{{ $teacher->email }}</td>
                                        <td>{{ $teacher->phone }}</td>
                                        <td>{{ $teacher->description }}</td>
                                        <td>
                                            <a href="{{ route('teachers.show', $teacher->id) }}"
                                                class="btn btn-info btn-sm">បង្ហាញ</a>
                                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                                class="btn btn-warning btn-sm">កែប្រែ</a>
                                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('តើអ្នកប្រាកដទេ?')">លុប</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">គ្មានទិន្នន័យ</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning m-3" role="alert">
                        🛑 មិនមានទិន្នន័យគ្រូទេ!
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
