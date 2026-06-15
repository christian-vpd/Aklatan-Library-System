@extends('master.librarian_master')
@section('librarian')
@include('librarian.announcement.modal.announcement_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Announcement</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addAnnouncement()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Announcement
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter</h3>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="alert alert-info" role="alert">
                <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                </div>
                You may use filters for quick navigation
            </div>
            <form action="{{ route('librarian.announcement.filter') }}" method="GET" id="announceFilterForm">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                        <p class="form-label">Status</p>
                        <select class="form-select" name="filter_active">
                            <option value="" disabled>Select Status</option>
                            <option value="1" {{ request('filter_active') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ request('filter_active') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                        <p class="form-label">Announcement Type</p>
                        <select class="form-select" name="filter_announcement_type">
                            <option value="" disabled>Select Announcement Type</option>
                            <option value="announcement" {{ request('filter_announcement_type') == 'announcement' ? 'selected' : '' }}>Announcement</option>
                            <option value="reminder" {{ request('filter_announcement_type') == 'reminder' ? 'selected' : '' }}>Reminder</option>
                            <option value="urgent" {{ request('filter_announcement_type') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-info btn-5" onclick="$(this).prop('disabled', true); $('#announceFilterForm').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-filter">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 4h16v2.172a2 2 0 0 1 -.586 1.414l-4.414 4.414v7l-6 2v-8.5l-4.48 -4.928a2 2 0 0 1 -.52 -1.345v-2.227" />
                            </svg>
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="announcementTable">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Created By</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date Posted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($announcement)
                        @foreach ($announcement as $item)
                            <tr>
                                <td class="text-truncate" style="max-width: 100px;">
                                    {{ $item->title }}
                                </td>
                                <td>{{ $item->librarian->first_name}} {{ $item->librarian->last_name}}</td>
                                <td>
                                    @switch($item->type)
                                        @case('announcement')
                                            <span class="badge bg-success text-success-fg">Announcement</span>
                                            @break
                                        @case('reminder')
                                            <span class="badge bg-info text-info-fg">Reminder</span>
                                            @break
                                        @case('urgent')
                                            <span class="badge bg-danger text-danger-fg">Urgent</span>
                                            @break
                                        @default
                                            <span class="badge bg-secondary text-secondary-fg">Unknown</span>
                                    @endswitch
                                </td>
                                <td>
                                    @php
                                        $status = Str::ucfirst($item->is_active);
                                    @endphp
                                    <span class="badge {{$status == 1 ? 'bg-success text-success-fg' : 'bg-danger text-danger-fg' }}">
                                        {{$status == 1 ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('F j, Y') }}</td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editAnnouncement({{$item->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteAnnouncement({{$item->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.js') }}"></script>
<script>
$(document).ready(function() {
    $('#announcementTable').DataTable({
        "columnDefs": [
            {
                "className": "dt-start",
                "targets": [0],
            },
            {
                "className": "dt-center",
                "targets": [1,2,3],
            },
            {
                "orderable": false,
                "targets": [-1],
            },
        ],
        "order": [[ 0, "asc"]],
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
    });

    // Tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    // CSRF TOKEN
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
<script>
    function addAnnouncement() {
        $('#addAnnouncementForm')[0].reset();
        $('#add-announcement-modal').modal('show');
    }

    $('#addAnnouncementForm').validate({

        rules: {

            title: {
                required: true
            },

            type: {
                required: true
            },

            body: {
                required: true
            },

        },

        messages: {

            title: {
                required: "Title is required"
            },

            type: {
                required: "Type is required"
            },

            body: {
                required: "Body is required"
            },

        },

        errorElement: 'div',
        errorClass: 'invalid-feedback',

        highlight: function (element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            // alert('Validation Passed');

            Swal.fire({
            title: "Add Announcement?",
            text: "This will add to announcement table!",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add announcement!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addAnnouncementSubmit').text('Submitting...')
                    $('#addAnnouncementSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function editAnnouncement(userId) {

        let url = "{{ route('librarian.announcement.edit', ':id')}}";
        url = url.replace(':id', userId);

        Swal.fire({
            title: 'Getting Announcement information!',
            text: 'Please wait for a while.',
            timer: 0,
            timerProgressBar: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
            didOpen: () => {
                Swal.showLoading();
            },
        });

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                Swal.close();
                $('#editAnnouncementForm')[0].reset();
                $('#edit_announcement_id').val(response.id);
                $('#edit_title').val(response.title);
                $('#edit_type').val(response.type);
                $('#edit_body').val(response.body);
                $('#edit_active').val(response.is_active);
                $('#edit-announcement-modal').modal('show');
            },
            error: function(xhr) {
                Swal.close();
                toastr.error('Something went wrong', 'Internal Server Error');
            }
        });
    }

    $('#editAnnouncementForm').validate({

        rules: {

            edit_title: {
                required: true
            },

            edit_type: {
                required: true
            },

            edit_body: {
                required: true
            },

        },

        messages: {

            edit_title: {
                required: "Title is required"
            },

            edit_type: {
                required: "Type is required"
            },

            edit_body: {
                required: "Body is required"
            },

        },

        errorElement: 'div',
        errorClass: 'invalid-feedback',

        highlight: function (element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },

        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },

        submitHandler: function (form) {
            // alert('Validation Passed');

            Swal.fire({
            title: "Update Announcement?",
            text: "This will update to announcement table!",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add announcement!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#editAnnouncementSubmit').text('Submitting...')
                    $('#editAnnouncementSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deleteAnnouncement(userId) {

        let url = "{{ route('librarian.announcement.delete', ':id')}}";
        url = url.replace(':id', userId);

        Swal.fire({
        title: "Delete Announcement Permanently?",
        text: "This cannot be undone.",
        icon: "warning",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting Announcement...',
                    text: 'Please wait for a while.',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    timer: 0,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                });

                $.ajax({
                    url: url,
                    type: 'DELETE',
                    success: function(response) {
                        if(response.status == 'success'){
                            Swal.fire({
                                title: "Success!",
                                text: "Announcement Deleted successfully!",
                                icon: "success"
                            }).then((result) => {
                                if(result.isConfirmed)
                                {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.close();
                        toastr.error('Something went wrong', 'Internal Server Error');
                    }
                });
            }
        });
    }
</script>
@endsection