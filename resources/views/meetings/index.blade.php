@extends('layouts.app')

@section('content')
    <div class="container-fluid"> {{-- changed from container to container-fluid --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">📅 កាលវិភាគប្រជុំ</h4>
                <a href="{{ route('meetings.create') }}" class="btn btn-light btn-sm">
                    ➕ បន្ថែមប្រជុំ
                </a>
            </div>
            <div class="card-body p-0">
                @if (!empty($meetings) && count($meetings))
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-0">
                            <thead class="table-secondary text-center">
                                <tr>
                                    <th>ល.រ</th>
                                    <th>ចំណងជើង</th>
                                    <th>កាលបរិច្ឆេទ</th>
                                    <th>ម៉ោង</th>
                                    <th>ទីតាំង</th>
                                    <th>អ្នកចូលរួម</th>
                                    <th>សកម្មភាព</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($meetings as $index => $meeting)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $meeting->title ?? 'N/A' }}</td>
                                        <td>{{ $meeting->date ?? 'N/A' }}</td>
                                        <td>{{ $meeting->start_time ?? 'N/A' }} - {{ $meeting->end_time ?? 'N/A' }}</td>
                                        <td>{{ $meeting->location }}</td>
                                        <td>
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($meeting->teachers as $teacher)
                                                    <li>
                                                        {{ $teacher->name }}
                                                        {{-- <span
                                                            class="badge
                                                            @if ($teacher->pivot->status == 'confirmed') bg-success
                                                            @elseif($teacher->pivot->status == 'declined') bg-danger
                                                            @else bg-secondary @endif">
                                                            {{ $teacher->pivot->status }}
                                                        </span> --}}

                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('meetings.edit', $meeting->id) }}"
                                                class="btn btn-sm btn-warning mb-1">កែប្រែ</a>
                                            <form action="{{ route('meetings.destroy', $meeting->id) }}" method="POST"
                                                style="display:inline-block;"
                                                onsubmit="return confirm('តើអ្នកចង់លុបមែនទេ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">លុប</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-warning m-3" role="alert">
                        🛑 មិនមានទិន្នន័យនៃប្រជុំទេ!
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
