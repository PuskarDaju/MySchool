@extends('layouts.admin')

@section('title', 'Assigned Subjects')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Assigned Subjects </h2>
        </div>
        <div class="card-body">
            @if($assignedSubjects==null)
                <p>No subjects assigned yet.</p>
            @else
                <ul class="list-group">
                    @foreach ($assignedSubjects as $subject)

                   
                        <li class="list-group-item">{{$subject}}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
