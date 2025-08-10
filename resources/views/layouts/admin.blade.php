<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>School Admin Panel</title>
    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

       @yield('scripts')
   
    <style>
        body { font-family: Arial, sans-serif; margin: 0; }
        .sidebar { width: 200px; background-color: #2c3e50; color: #fff; height: 100vh; float: left; padding-top: 20px; }
        .sidebar a { color: #fff; display: block; padding: 12px 20px; text-decoration: none; }
        .sidebar a:hover { background-color: #34495e; }
        .content { margin-left: 200px; padding: 20px; }
        .header { background-color: #3498db; color: #fff; padding: 15px; }
    </style>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <div class="sidebar">
        <h2 class="text-center">Admin Panel</h2>
        <a href={{ route('admin.students') }}>Students</a>
        <a href="{{ route('admin.teachers.show') }}">Teachers</a>
        <a href="{{ route('admin.classes.show') }}">Classes</a>
        <a href="{{ route('admin.subjects.show') }}">Subjects</a>
        <a href="{{ route('routine.index') }}">Routine</a>
        <a href="{{ route("admin.notification.form") }}">Announcements</a>
    </div>

    <div class="content">
        <div class="header">
            <h1>@yield('title', 'Dashboard')</h1>
        </div>

        <div>
            @yield('content')
        </div>

        @yield('myjs')
      
    </div>
</body>
</html>
