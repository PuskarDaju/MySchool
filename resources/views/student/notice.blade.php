@extends('layouts.sutdent')

@section('student-content')
<style>
    .card {
        border-radius: 12px;
    }
    .notice-card {
        transition: transform 0.2s ease-in-out;
    }
    .notice-card:hover {
        transform: scale(1.02);
    }
</style>

<div class="card shadow-lg border-0">
    <div class="card-header bg-warning text-dark">
        <h4 class="mb-0">📢 Notices for Students</h4>
    </div>
    <div class="card-body">
        @if($notices->isEmpty())
            <div class="alert alert-info">No notices available at the moment.</div>
        @else
          @foreach($notices as $notice)
            <div class="card mb-4 shadow-sm border-{{ $notice->type === 'urgent' ? 'danger' : 'primary' }}">
                <div class="card-body">
                    <!-- Title -->
                    <h5 class="card-title text-{{ $notice->type === 'urgent' ? 'danger' : 'primary' }}">
                        {{ $notice->title }}
                    </h5>

                    <!-- Description -->
                    <p class="card-text">
                        {!! nl2br(e($notice->description)) !!}
                    </p>

                    <!-- Meta info -->
                    <small class="text-muted d-block mb-2">
                        📅 Posted on {{ $notice->created_at->format('d M Y, h:i A') }}
                        — <strong>{{ ucfirst($notice->type) }} Notice</strong>
                    </small>

                    <!-- Image (responsive) -->
                    @if(!empty($notice->path))
                        <a href="{{ asset('storage/' . $notice->path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $notice->path) }}" 
                                alt="Notice Image" 
                                class="img-fluid rounded"
                                style="max-height: 300px; object-fit: cover; cursor: zoom-in;">
                        </a>
                    @endif
                </div>
            </div>
          @endforeach
        @endif
    </div>
</div>
@endsection
