@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Edit Student</h2>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Something went wrong.</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.subjects.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $student->name) }}" 
                        class="form-control" 
                        required>
                </div>
                <button type="submit" class="btn btn-primary">Update Subject</button>
                <a href="{{ route('admin.subjects.show') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
<style>
    .card {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin: 20px 0;
    }

    .card-header {
        padding: 16px 20px;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .card-body {
        padding: 20px;
    }

    form .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        font-size: 1rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        transition: border-color 0.2s ease-in-out;
    }

    .form-control:focus {
        border-color: #007bff;
        outline: none;
        box-shadow: 0 0 4px rgba(0,123,255,.25);
    }

    .btn {
        padding: 8px 16px;
        font-size: 1rem;
        border-radius: 4px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: #fff;
        display: inline-block;
        margin-right: 10px;
        user-select: none;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0069d9;
    }

    .btn-secondary {
        background-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border-left: 4px solid #dc3545;
        padding: 10px 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
</style>
@endsection
