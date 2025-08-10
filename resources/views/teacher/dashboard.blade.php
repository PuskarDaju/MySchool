
@extends('layouts.teacher')

@section('teacher-content')
<div class="mb-4">
    <h2 class="fw-bold">Welcome, {{ auth()->user()->name }} 👋</h2>
    <p class="text-muted">Here's a quick overview of your teaching activities.</p>
</div>

<div class="row g-4">
    <!-- Routine Card -->
    <div class="col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-primary text-white rounded-circle p-3">
                        <i class="bi bi-calendar3 fs-2"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">My Routine</h5>
                        <p class="card-text text-muted mb-0">View your class schedule</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Notices Card -->
    <div class="col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-success text-white rounded-circle p-3">
                        <i class="bi bi-megaphone fs-2"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Notices</h5>
                        <p class="card-text text-muted mb-0">Stay updated with announcements</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Attendance Report Card -->
    <div class="col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-warning text-white rounded-circle p-3">
                        <i class="bi bi-file-text fs-2"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Attendance Report</h5>
                        <p class="card-text text-muted mb-0">Manage daily student attendance</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Exam Marks Card -->
    <div class="col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-danger text-white rounded-circle p-3">
                        <i class="bi bi-pencil-square fs-2"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Exam Marks</h5>
                        <p class="card-text text-muted mb-0">Enter and update student exam marks</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <!-- Shared Files Card -->
    <div class="col-md-4">
        <a href="#" class="text-decoration-none">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="me-3 bg-info text-white rounded-circle p-3">
                        <i class="bi bi-folder2-open fs-2"></i>
                    </div>
                    <div>
                        <h5 class="card-title mb-1">Shared Files</h5>
                        <p class="card-text text-muted mb-0">Access and share notes, PDFs, and more</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

@endsection
