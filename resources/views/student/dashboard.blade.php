@extends('layouts.sutdent')
@section('student-content')

@section('student-content')
<style>
    .card {
        border-radius: 12px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .dashboard-header {
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 30px;
    }
    .card-icon {
        font-size: 48px;
        color: #3498db;
        margin-bottom: 15px;
    }
</style>

<div class="container mt-4">
    <h2 class="dashboard-header">👋 Welcome, {{ $student->name }}!</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('student.routine') }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-calendar3"></i>
                    </div>
                    <h5 class="card-title text-primary">My Routine</h5>
                    <p class="card-text text-muted">Check your class timetable</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('student.notices') }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <h5 class="card-title text-primary">Notices</h5>
                    <p class="card-text text-muted">View latest announcements</p>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('student.files') }}" class="text-decoration-none">
                <div class="card text-center p-4 shadow-sm">
                    <div class="card-icon">
                        <i class="bi bi-folder2-open"></i>
                    </div>
                    <h5 class="card-title text-primary">Shared Files</h5>
                    <p class="card-text text-muted">Download notes and resources</p>
                </div>
            </a>
        </div>
    </div>
</div>




@endSection