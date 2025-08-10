@extends('layouts.admin')

@section('title', 'Create New Student')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Create New Subject</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subjects.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Create Subject</button>
                <a href="{{ route('admin.subjects.show') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
