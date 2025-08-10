@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h3>Routines by Semester</h3>

    <table class="table table-bordered text-center align-middle">
        <thead class="table-primary">
            <tr>
                <th>Semester</th>
                @for ($period = 1; $period <= $maxPeriods; $period++)
                    <th>Period {{ $period }}</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @foreach($classes as $class)
                <tr>
                    <td><strong>{{ $class->name }}</strong></td>
                    @for ($period = 1; $period <= $maxPeriods; $period++)
                        @php
                            $routine = $class->routines->firstWhere('period', $period);
                        @endphp
                        <td>
                            @if ($routine)
                                <div><strong>{{ $routine->subject->name }}</strong></div>
                                <small class="text-muted">{{ $routine->teacher->name }}</small>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    @endfor
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($classes->isEmpty())
        <div class="alert alert-info text-center">
            No routines found. Please create routines first.
        </div>
    @endif
</div>
@endsection
