{{-- resources/views/layouts/teacher.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('scripts')

    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .sidebar {
            width: 200px;
            background-color: #2c3e50;
            color: #fff;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .content {
            margin-left: 200px; /* Push content to the right of sidebar */
            padding: 20px;
        }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Sidebar -->
    <aside class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}" href="{{ route('teacher.dashboard') }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.routine') ? 'active' : '' }}" href="{{ route('teacher.routine') }}">
                    <i class="bi bi-calendar3"></i> My Routine
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.notices') ? 'active' : '' }}" href="{{ route('teacher.notice') }}">
                    <i class="bi bi-megaphone"></i> Notices
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.attendance') ? 'active' : '' }}" href="">
                    <i class="bi bi-file-text"></i> Attendance Report
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.exams') ? 'active' : '' }}" href="">
                    <i class="bi bi-pencil-square"></i> Exam Marks
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link {{ request()->routeIs('teacher.files') ? 'active' : '' }}" href="">
                    <i class="bi bi-folder2-open"></i> Shared Files
                </a>
            </li>
        </ul>
    </aside>

    <!-- Main Content -->
    <div class="content">
        <div class="container-fluid mt-4">
            @yield('teacher-content')
        </div>
    </div>

</body>
</html>

