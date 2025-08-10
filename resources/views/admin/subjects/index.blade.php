@extends('layouts.admin')

@section('title', 'Student List')
<style>
    .table-container {
        overflow-x: auto;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    thead {
        background-color: #f8f9fa;
    }

    thead th {
        padding: 12px;
        text-align: left;
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
    }

    tbody td {
        padding: 12px;
        border-bottom: 1px solid #e9ecef;
    }

    tbody tr:hover {
        background-color: #f1f3f5;
    }

    .btn {
        padding: 6px 12px;
        border: none;
        border-radius: 4px;
        font-size: 0.875rem;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn + .btn {
        margin-left: 6px;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        padding: 10px 15px;
        border-left: 4px solid #28a745;
        margin-bottom: 20px;
        border-radius: 4px;
    }
</style>

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Subjects List</h2>
            <a href="{{ route('admin.subjects.create') }}" class="btn btn-primary">+ Create New Subject</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($students->count() > 0)
                <table class="table table-bordered table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                               
                                <td>
                                    <a href="{{ route('admin.subjects.edit',$student->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.subjects.delete',$student->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No students found.</p>
            @endif
        </div>
    </div>
@endsection
