{{-- resources/views/student/files/index.blade.php --}}
@extends('layouts.sutdent')

@section('student-content')
<style>
    .folder-card {
        border-radius: 12px;
        transition: box-shadow 0.3s ease;
        cursor: default;
        border: 1px solid #e3e6f0;
        background: #fff;
    }
    .folder-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }
    .file-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f3f7;
        transition: background-color 0.15s ease;
    }
    .file-item:last-child {
        border-bottom: none;
    }
    .file-item:hover {
        background-color: #f8f9fc;
    }
    .file-name {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 500;
        color: #2c3e50;
        font-size: 1rem;
        overflow-wrap: anywhere;
    }
    .file-actions a {
        margin-left: 0.5rem;
    }
    .empty-message {
        font-style: italic;
        color: #6c757d;
        text-align: center;
        padding: 2rem 0;
    }
</style>

<div class="container my-4">
    <h3 class="mb-4 text-primary fw-bold">📁 Shared Files</h3>

    @if($folders->isEmpty())
        <div class="alert alert-info empty-message">No shared folders or files available currently.</div>
    @else
        <div class="row gy-4">
            @foreach ($folders as $folder)
                <div class="col-md-6 col-lg-4">
                    <div class="folder-card shadow-sm">
                        <div class="card-header bg-primary text-white rounded-top">
                            <h5 class="mb-0">{{ $folder->name }}</h5>
                        </div>

                        @if($folder->files->isEmpty())
                            <p class="empty-message mb-3">No files in this folder.</p>
                        @else
                            <div>
                                @foreach ($folder->files as $file)
                                    <div class="file-item">
                                        <div class="file-name">
                                            <i class="bi bi-file-earmark-text fs-5 text-primary"></i>
                                            <span>{{ $file->name }}</span>
                                        </div>
                                        <div class="file-actions">
                                            <a href="{{ asset('storage/' . $file->path) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="View {{ $file->name }}">
                                                <i class="bi bi-eye"></i> View
                                            </a>
                                            <a href="{{ route('files.download', $file->id) }}" class="btn btn-sm btn-primary" title="Download {{ $file->name }}">
                                                <i class="bi bi-download"></i> Download
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
