@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📢 Publish Notification</h4>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.notification.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control" required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" id="description" rows="4" class="form-control" required></textarea>
                </div>

                {{-- To --}}
                <div class="mb-3">
                    <label for="to" class="form-label fw-semibold">To <span class="text-danger">*</span></label>
                    <select name="to" id="to" class="form-select" required>
                        <option value="" disabled selected>Select recipient</option>
                        <option value="teacher">Teacher</option>
                        <option value="student">Student</option>
                        <option value="general">General</option>
                    </select>
                </div>

                {{-- Attachment --}}
                <div class="mb-3">
                    <label for="path" class="form-label fw-semibold">Attach Photo (optional)</label>
                    <input type="file" name="path" id="path" class="form-control" accept="image/*">
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Publish
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
