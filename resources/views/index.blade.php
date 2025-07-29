{{-- resources/views/meetings/index.blade.php --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>កិច្ចការប្រជុំ - @yield('title', '')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 56px;
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .meeting-card {
            margin-bottom: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 0.2rem 0.5rem rgba(0, 0, 0, 0.1);
            background-color: #fff;
            transition: transform 0.2s ease-in-out;
            cursor: default;
            border: none;
        }

        .meeting-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 0.6rem 1.2rem rgba(0, 0, 0, 0.15);
        }

        .meeting-header {
            background: linear-gradient(90deg, #0069d9, #004085);
            color: white;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: 1.5rem;
            box-shadow: inset 0 -3px 8px rgba(255, 255, 255, 0.2);
        }

        .meeting-body {
            padding: 1.5rem 1.75rem;
            color: #333;
        }

        .meeting-body p {
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .meeting-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .meeting-info div {
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            color: #555;
        }

        .meeting-info div svg {
            margin-right: 0.5rem;
            fill: #0d6efd;
            flex-shrink: 0;
        }

        .participants-list {
            list-style: none;
            padding-left: 0;
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 0.4rem;
            padding: 0.5rem 1rem;
            background: #f1f5f9;
        }

        .participants-list li {
            padding: 0.3rem 0;
            border-bottom: 1px solid #dee2e6;
            font-weight: 500;
        }

        .participants-list li:last-child {
            border-bottom: none;
        }

        .no-participants {
            color: #888;
            font-style: italic;
            padding-left: 0.5rem;
        }
    </style>
</head>

<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">កិច្ចការប្រជុំ</a>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="container mt-4">
        @if ($meetings->isEmpty())
            <div class="alert alert-info text-center fs-5">មិនមានកិច្ចប្រជុំសម្រាប់បង្ហាញទេ។</div>
        @else
            @foreach ($meetings as $meeting)
                <div class="card meeting-card shadow-sm">
                    <div class="meeting-header">{{ $meeting->title }}</div>
                    <div class="meeting-body">
                        <p>{{ $meeting->description }}</p>

                        <div class="meeting-info">
                            <div title="កាលបរិច្ឆេទប្រជុំ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M19 4h-1V2h-2v2H8V2H6v2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zM5 20V9h14v11H5z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($meeting->start_date)->format('d/m/Y') ?? 'មិនមាន' }}
                                -
                                {{ \Carbon\Carbon::parse($meeting->end_date)->format('d/m/Y') ?? 'មិនមាន' }}
                            </div>

                            <div title="ម៉ោងចូល - ម៉ោងចេញ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6zm-.5 3v5l4.25 2.52.75-1.23-3.5-2.08V9z" />
                                </svg>
                                ចូល: {{ \Carbon\Carbon::parse($meeting->start_time)->format('H:i') ?? 'មិនមាន' }},
                                ចេញ: {{ \Carbon\Carbon::parse($meeting->end_time)->format('H:i') ?? 'មិនមាន' }}
                            </div>

                            <div title="ចំនួនថ្ងៃ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2zm0 16H5V5h14v14zM7 7h10v2H7V7zm0 4h7v2H7v-2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($meeting->start_date)->diffInDays(\Carbon\Carbon::parse($meeting->end_date)) + 1 }}
                                ថ្ងៃ
                            </div>

                            <div title="ទីតាំង">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5z" />
                                </svg>
                                {{ $meeting->location ?? 'មិនមាន' }}
                            </div>
                        </div>

                        <p><strong>សមាជិកត្រូវចូលរួម៖</strong></p>
                        @if ($meeting->teachers->isEmpty())
                            <p class="no-participants">គ្មានសមាជិកចូលរួម</p>
                        @else
                            <ul class="participants-list">
                                @foreach ($meeting->teachers as $teacher)
                                    <li>👤 {{ $teacher->name }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
