@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Notifications</h3>
        <a href="{{ route('admin.notification.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Create New Notification
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="notificationsTable" class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Recipient</th>
                        <th>Title</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td>{{ ucfirst($notification->to) }}</td>
                            <td>{{ $notification->title }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.notification.edit',$notification->id) }}" 
                                   class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-eye"></i> View
                                </a>

                               <form id="delete-form-{{ $notification->id }}" 
      action="{{ route('admin.notification.delete', $notification->id) }}" 
      method="POST" 
      class="d-inline">
    @csrf
    @method('DELETE')
    <button type="button" 
            class="btn btn-sm btn-danger" 
            onclick="confirmDelete({{ $notification->id }})">
        <i class="bi bi-trash"></i> Delete
    </button>
</form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- DataTables Script --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let table = new DataTable('#notificationsTable');
    });

function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the notification.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}


</script>

{{-- DataTables CSS --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection
