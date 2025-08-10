@extends('layouts.admin')

@section('title', 'Assign Subjects to Teacher')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Assign Subjects to {{ $teacher->name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.assignSubjects', $teacher->id) }}" method="POST">
                @csrf
                

                <div id="subject-wrapper">
                    <div class="subject-group mb-3 d-flex align-items-center">
                        <select name="subject_ids[]" class="form-control" required>
                            <option value="">-- Select Subject --</option>
                            @foreach ($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-secondary ms-2 remove-subject">Remove</button>
                    </div>
                </div>

                <button type="button" id="add-subject" class="btn btn-primary mb-3">+ Add More Subject</button>
                <br>
                <button type="submit" class="btn btn-success">Assign Subjects</button>
            </form>
        </div>
    </div>
@endsection

@section('myjs')
    <script>
        document.getElementById('add-subject').addEventListener('click', function () {
            const wrapper = document.getElementById('subject-wrapper');
            const group = document.createElement('div');
            group.classList.add('subject-group', 'mb-3', 'd-flex', 'align-items-center');

            group.innerHTML = `
                <select name="subject_ids[]" class="form-control" required>
                    <option value="">-- Select Subject --</option>
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-secondary ms-2 remove-subject">Remove</button>
            `;
            wrapper.appendChild(group);
        });

        // Event delegation for remove buttons
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-subject')) {
                e.target.closest('.subject-group').remove();
            }
        });
    </script>
@endsection

@section('styles')
    <style>
        .subject-group select {
            width: 300px;
        }
    </style>
@endsection
