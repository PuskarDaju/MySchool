<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @yield('scripts')

    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .sidebar {
            width: 200px;
            background-color: #1e3a8a; /* nicer blue */
            color: #fff;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-weight: 500;
            font-size: 16px;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #2563eb;
            color: #fff;
        }
        .content {
            margin-left: 200px;
            padding: 25px;
            min-height: 100vh;
            background: #f8fafc;
        }
        .header {
            background-color: #2563eb;
            color: #fff;
            padding: 15px;
            font-size: 22px;
            font-weight: 600;
            box-shadow: 0 2px 4px rgb(0 0 0 / 0.1);
        }
    </style>
</head>
<body>

    <aside class="sidebar">
        <a href="{{ route('student.dashboard') }}" class="{{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('student.routine') }}" class="{{ request()->routeIs('student.routine') ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> My Routine
        </a>
        <a href="{{ route('student.notices') }}" class="{{ request()->routeIs('student.notices') ? 'active' : '' }}">
            <i class="bi bi-megaphone"></i> Notices
        </a>
        <a href="{{ route('student.files') }}" class="{{ request()->routeIs('student.files') ? 'active' : '' }}">
            <i class="bi bi-folder2-open"></i> Shared Files
        </a>
    </aside>

    <div class="content">
        <div class="header">
            Welcome, {{ Auth::user()->name ?? 'Student' }}
        </div>

        <div class="mt-4">
            @yield('student-content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('scripts')

</body>
</html>
