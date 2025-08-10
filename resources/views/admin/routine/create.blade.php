@extends('layouts.admin')

@section('content')
<div class="container mt-5" style="max-width: 900px;">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📅 Bulk Routine for Class: {{ $class->name }}</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>⚠️ {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('routine.save',$class->id) }}" method="POST">
                @csrf

                <div id="validationErrors" class="alert alert-danger d-none"></div>

                <table class="table table-bordered align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>Period</th>
                            <th>Subject</th>
                            <th>Teacher</th>
                        </tr>
                    </thead>
                    <tbody>
                      @for ($period = 1; $period <= 5; $period++)
                        @php
                            $subjectId = $existingRoutine[$period]->subject_id ?? null;
                            $teacherId = $existingRoutine[$period]->teacher_id ?? null;

                            // Busy teachers for this period in any class
                            $busyInThisPeriod = $busyTeacherAssignments[$period] ?? [];

                            // We show a teacher if they are NOT busy in this period OR
                            // they are the currently assigned teacher for this period in this class
                        @endphp
                        <tr>
                            <td><strong>{{ $period }}</strong></td>
                            <td>
                                <select name="periods[{{ $period }}][subject_id]" class="form-select">
                                    <option value="">-- Select Subject --</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ old("periods.$period.subject_id", $subjectId) == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="periods[{{ $period }}][teacher_id]" class="form-select">
                                    <option value="">-- Select Teacher --</option>
                                    @foreach ($teachers as $teacher)
                                        @php
                                            $isBusy = in_array($teacher->id, $busyInThisPeriod);
                                            $showTeacher = !$isBusy || $teacher->id == $teacherId;
                                        @endphp
                                        @if ($showTeacher)
                                            <option value="{{ $teacher->id }}" {{ old("periods.$period.teacher_id", $teacherId) == $teacher->id ? 'selected' : '' }}>
                                                {{ $teacher->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                      @endfor
                    </tbody>
                </table>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="bi bi-save"></i> Save Routine
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const errorDiv = document.getElementById('validationErrors');

    const subjectSelects = Array.from(document.querySelectorAll('select[name^="periods"][name$="[subject_id]"]'));
    const teacherSelects = Array.from(document.querySelectorAll('select[name^="periods"][name$="[teacher_id]"]'));

    function updateSubjectOptions() {
        const selectedSubjects = subjectSelects.map(sel => sel.value);

        subjectSelects.forEach((select) => {
            Array.from(select.options).forEach(option => {
                if (option.value === "") {
                    option.hidden = false; // always show placeholder
                    return;
                }
                option.hidden = selectedSubjects.includes(option.value) && option.value !== select.value;
            });
        });
    }

    updateSubjectOptions();

    subjectSelects.forEach(select => {
        select.addEventListener('change', updateSubjectOptions);
    });

    form.addEventListener('submit', function(e) {
        let valid = true;
        let errors = [];

        subjectSelects.forEach((select, idx) => {
            const subject = select.value;
            const teacher = teacherSelects[idx].value;
            const period = idx + 1;

            if (!subject) {
                valid = false;
                errors.push(`Period ${period}: Subject is required.`);
            }
            if (!teacher) {
                valid = false;
                errors.push(`Period ${period}: Teacher is required.`);
            }
        });

        let subjects = subjectSelects.map(s => s.value).filter(v => v !== "");
        let duplicates = subjects.filter((item, index) => subjects.indexOf(item) !== index);

        if (duplicates.length > 0) {
            valid = false;
            errors.push(`Duplicate subjects selected: ${[...new Set(duplicates)].join(", ")}`);
        }

        if (!valid) {
            e.preventDefault();

            // Show errors inside the errorDiv
            errorDiv.innerHTML = '<ul class="mb-0">' + errors.map(err => `<li>${err}</li>`).join('') + '</ul>';
            errorDiv.classList.remove('d-none');
        } else {
            // Clear errors on successful validation
            errorDiv.innerHTML = '';
            errorDiv.classList.add('d-none');
        }
    });
});
</script>

@endsection
