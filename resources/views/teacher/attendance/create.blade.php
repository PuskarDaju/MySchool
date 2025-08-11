@extends('layouts.teacher')

@section('teacher-content')
<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">📋 Take Attendance</h4>
    </div>
    <div class="card-body">
        @if($classes->isEmpty())
            <div class="alert alert-warning">You are not assigned to any class.</div>
        @else
            <form action="" method="GET">
                <div class="mb-3">
                    <label for="class_id" class="form-label">Select Class</label>
                    <select name="class_id" id="class_id" class="form-select" required>
                        <option value="">-- Select Class --</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Next</button>
            </form>
        @endif
    </div>
</div>
@endsection
