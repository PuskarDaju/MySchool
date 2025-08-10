@extends('layouts.admin')

@section('title', 'Create New Class')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.classes.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name"
                           value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Create Classes</button>
                <a href="{{ route('admin.classes.show') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
