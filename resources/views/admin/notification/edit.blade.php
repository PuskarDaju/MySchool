@extends('layouts.admin')

@section('content')
<div class="container d-flex justify-content-center mt-5">
    <div class="card shadow-sm w-100" style="max-width: 600px;">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📢 Update Notification</h4>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('admin.notification.update', $notification->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           class="form-control" 
                           value="{{ old('title', $notification->title) }}" 
                           required>
                </div>

                {{-- Description --}}
                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Description <span class="text-danger">*</span></label>
                    <textarea name="description" 
                              id="description" 
                              rows="4" 
                              class="form-control" 
                              required>{{ old('description', $notification->description) }}</textarea>
                </div>

                {{-- To --}}
                <div class="mb-3">
                    <label for="to" class="form-label fw-semibold">To <span class="text-danger">*</span></label>
                    <select name="to" id="to" class="form-select" required>
                        <option value="" disabled>Select recipient</option>
                        <option value="teacher" {{ old('to', $notification->to) === 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="student" {{ old('to', $notification->to) === 'student' ? 'selected' : '' }}>Student</option>
                        <option value="general" {{ old('to', $notification->to) === 'general' ? 'selected' : '' }}>General</option>
                    </select>
                </div>

                {{-- Attachment --}}
                <div class="mb-3">
                    <label for="path" class="form-label fw-semibold">Attach Photo (optional)</label>
                    <input type="file" 
                           name="path" 
                           id="path" 
                           class="form-control" 
                           accept="image/*">

                    @if ($notification->path)
                        <div class="mt-2">
                            <small class="text-muted">Current Image:</small><br>
                            <img src="{{ asset('storage/' . $notification->path) }}" 
                                 alt="Notification Image" 
                                 class="img-thumbnail mt-1" 
                                 style="max-width: 150px;">
                        </div>
                    @endif
                </div>

                {{-- Submit --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
