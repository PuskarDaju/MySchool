@extends('layouts.teacher')

@section('teacher-content')
<style>
    .card {
        border-radius: 12px;
    }
    table {
        font-size: 15px;
    }
    thead th {
        text-align: center;
    }
    .day-header {
        background-color: #f8f9fa;
        font-weight: bold;
        font-size: 16px;
        padding: 10px;
    }
</style>

<div class="card shadow-lg border-0">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">📅 My Teaching Routine</h4>
    </div>
    <div class="card-body">
        @if($routines->isEmpty())
            <div class="alert alert-info">You have no routine assigned yet.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Period</th>
                            <th>Class</th>
                            <th>Subject</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $currentDay = null;
                        @endphp
                        @foreach($routines as $routine)
                            @if($currentDay !== $routine->day)
                                <tr>
                                    <td colspan="3" class="day-header">{{ ucfirst($routine->day) }}</td>
                                </tr>
                                @php
                                    $currentDay = $routine->day;
                                @endphp
                            @endif
                            <tr>
                                <td class="text-center">{{ $routine->period }}</td>
                                <td class="text-center">{{ $routine->class->name }}</td>
                                <td class="text-center">{{ $routine->subject->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
