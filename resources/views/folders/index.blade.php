@extends("layouts.teacher")

@section('teacher-content')
<div class="container my-4">
    <h2 class="mb-4">My Folders</h2>

    {{-- Create Folder Form --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('folders.store') }}" class="row g-3 align-items-center">
                @csrf
                <div class="col-auto flex-grow-1">
                    <input type="text" name="name" class="form-control" placeholder="Enter new folder name" required>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Create Folder</button>
                </div>
            </form>
        </div>
    </div>

    {{-- List of Folders --}}
    @foreach($folders as $folder)
    <div class="card mb-4 shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ $folder->name }}</h5>

            {{-- Upload File Form --}}
            <form method="POST" action="{{ route('files.store', $folder->id) }}" enctype="multipart/form-data" class="d-flex align-items-center" style="gap: 10px;">
                @csrf
                <input type="file" name="file" class="form-control form-control-sm" required>
                <button type="submit" class="btn btn-success btn-sm">Upload</button>
            </form>
        </div>

        <div class="card-body p-3">
            @if($folder->files->isEmpty())
                <p class="text-muted mb-0">No files uploaded yet.</p>
            @else
                <ul class="list-group list-group-flush">
                    @foreach($folder->files as $file)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $file->name }}</span>
                            <a href="{{ route('files.download', $file->id) }}" class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener">
                                Download
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @endforeach
</div>
@endsection
