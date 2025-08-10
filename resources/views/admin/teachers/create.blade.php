@extends('layouts.admin')

@section('title', 'Create New Teacher')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Create New Teacher</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Create Teacher</button>
                <a href="" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
