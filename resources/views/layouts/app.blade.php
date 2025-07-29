<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 56px;
            left: 0;
            width: 240px;
            background-color: #343a40;
            padding-top: 1rem;
        }
        .sidebar a {
            color: #ffffff;
            padding: 10px 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 240px;
            padding: 1.5rem;
        }

    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <div class="dropdown ms-auto">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=0D8ABC&color=fff&size=32"
                        alt="Profile" class="rounded-circle me-2" width="32" height="32" />
                    <strong>Admin</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow"
                    aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">ប្រវត្តិរូប</a></li>
                    <li><a class="dropdown-item" href="#">ការកំណត់</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item text-danger" href="#">ចាកចេញ</a></li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Sidebar --}}
    @php
        $route_current = Route::currentRouteName();
    @endphp
    <div class="sidebar" style="padding-top: 0px;">
        <a href="{{ route('meetings.index') }}" class="{{ $route_current == 'meetings.index' ? 'bg-secondary' : '' }}">📅 Meeting</a>
        <a href="{{ route('teachers.index') }}" class="{{ $route_current == 'teachers.index' ? 'bg-secondary' : '' }}">👩‍🏫 Teachers</a>

    </div>

    {{-- Content --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
