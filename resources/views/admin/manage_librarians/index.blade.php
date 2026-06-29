@extends('master.admin_master')
@section('admin')
@include('admin.manage_librarians.modal.manage_librarians_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Admin</div>
            <h2 class="page-title">Manage Librarians</h2>
        </div>
        <!-- Page title actions -->
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" data-bs-toggle="modal" data-bs-target="#add-librarian-modal">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Librarian
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row w-100">
                <div class="col d-flex align-items-center">
                    <h3 class="card-title">Active Librarians</h3>
                </div>
                <div class="col d-flex justify-content-end">
                    <button class="btn btn-info" onclick="viewInactiveLibrarian()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                    </svg>
                    View Inactive Librarians
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="librarianTable">
                <thead>
                    <tr>
                        <th>Librarian Code</th>
                        <th>Profile</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($librarians)
                        @foreach ($librarians as $item)    
                        <tr>
                            <td>{{ $item->librarian_code}}</td>
                            <td>
                                <div class="row">
                                    <div class="col-2">
                                        @php
                                            $profilePicture = $item->profile_picture;

                                            $avatar = asset('assets/images/default_profile.jpg');

                                            if (!empty($profilePicture) && Storage::disk('public')->exists($profilePicture)) {
                                                $avatar = Storage::url($profilePicture);
                                            }
                                        @endphp
                                        <span class="avatar avatar-md" style="background-image: url('{{ $avatar }}')"></span>
                                    </div>
                                    <div class="col-10 text-start d-flex flex-column">
                                        <div class="fw-bold">
                                            {{ $item->first_name}}
                                            {{ $item->middle_name ? substr(strtoupper($item->middle_name), 0, 1) . '.' : '' }}
                                            {{ $item->last_name}}
                                            {{ $item->suffix ?? '' }}
                                        </div>
                                        <div>
                                            {{ $item->user->email}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->gender}}</td>
                            <td>
                                <div class="btn-actions d-flex justify-content-center align-items-center">
                                    <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editLibrarianModal({{$item->user->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                        </svg>
                                    </button>
                                    <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Toggle Inactive" onclick="toggleInactive({{$item->user->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-off">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8.18 8.189a4.01 4.01 0 0 0 2.616 2.627m3.507 -.545a4 4 0 1 0 -5.59 -5.552" />
                                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.412 0 .81 .062 1.183 .178m2.633 2.618c.12 .38 .184 .785 .184 1.204v2" />
                                            <path d="M3 3l18 18" />
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
$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#librarianTable').DataTable({
        "columnDefs": [
            {
                "className": "dt-center",
                "targets": "_all"
            },
            {
                "targets": [-1],
                "searchable": false,
                "orderable": false,
            }
        ],
        "order": [[ 0, "desc"]],
        paging: true,
        searching: true,
        ordering: true,
        responsive: true,
    });

    $('.no-numbers').on('input', function () {
        this.value = this.value.replace(/\d/g, '');
    });

});

$('#addLibrarianForm').validate({

    rules: {

        libraryCode: {
            required: function () {
                return $('#customCodeCheck').is(':checked');
            }
        },

        lastName: {
            required: true
        },

        firstName: {
            required: true
        },

        contactNumber: {
            required: true
        },

        email: {
            required: true,
            email: true,

            remote: {
                url: "{{ route('admin.manage_librarians.checkEmail') }}",
                type: "POST",
                data: {
                    email: function () {
                        return $('#email').val();
                    },
                    _token: "{{ csrf_token() }}"
                }
            }
        },

        gender: {
            required: true
        }
    },

    messages: {

        libraryCode: {
            required: "Library code is required"
        },

        lastName: {
            required: "Last name is required"
        },

        firstName: {
            required: "First name is required"
        },

        contactNumber: {
            required: "Contact number is required"
        },

        email: {
            required: "Email address is required",
            email: "Please enter a valid email",
            remote: "Email already exists"
        },

        gender: {
            required: "Please select gender"
        }
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
        title: "Add Librarian?",
        text: "You won't be able to revert this!",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, add Librarian!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#addLibrarianSubmit').text('Submitting...')
                $('#addLibrarianSubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

$('input[name="contactNumber"]').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

function toggleAddCustomCode() {

    const customCodeCheck = document.getElementById("customCodeCheck");
    const libraryCode = document.getElementById("libraryCode");

    if (customCodeCheck.checked) {

        libraryCode.removeAttribute('disabled');

    } else {

        libraryCode.setAttribute('disabled', 'disabled');
        libraryCode.value = '';

        $('#libraryCode').removeClass('is-invalid');
    }
}

function resetAddLibrarian() {
    $('#addLibrarianForm')[0].reset();
}

function resetEditLibrarian() {
    $('#editLibrarianForm')[0].reset();
}

// Tooltip
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

// Edit
function editLibrarianModal(userId) {

    let url = "{{ route('admin.manage_librarians.edit', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
        title: 'Getting Librarian information!',
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
            $('#edit_user_id').val(response.id);
            $('#edit_lastName').val(response.librarian.last_name);
            $('#edit_firstName').val(response.librarian.first_name);
            $('#edit_middleName').val(response.librarian.middle_name);
            $('#edit_suffix').val(response.librarian.suffix);
            $('#edit_contactNumber').val(response.librarian.contact_number);
            $('#edit_email').val(response.email);
            $('#edit_gender').val(response.librarian.gender);
            $('#edit-librarian-modal').modal('show');
        },
        error: function(xhr) {
            Swal.close();
            toastr.error('Something went wrong', 'Internal Server Error');
        }
    });
}

$('#editLibrarianForm').validate({

    rules: {

        edit_lastName: {
            required: true
        },

        edit_firstName: {
            required: true
        },

        edit_contactNumber: {
            required: true
        },

        edit_email: {
            required: true,
            email: true,

            remote: {
                url: "{{ route('admin.manage_librarians.checkEmail') }}",
                type: "POST",
                data: {
                    email: function () {
                        return $('#edit_email').val();
                    },
                    user_id: function () {
                        return $('#edit_user_id').val();
                    },
                    _token: "{{ csrf_token() }}"
                }
            }
        },

        edit_gender: {
            required: true
        }
    },

    messages: {

        edit_lastName: {
            required: "Last name is required"
        },

        edit_firstName: {
            required: "First name is required"
        },

        edit_contactNumber: {
            required: "Contact number is required"
        },

        edit_email: {
            required: "Email address is required",
            email: "Please enter a valid email",
            remote: "Email already exists"
        },

        edit_gender: {
            required: "Please select gender"
        }
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
        title: "Update Librarian?",
        text: "You won't be able to revert this!",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, update it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#editLibrarianSubmit').text('Submitting...')
                $('#editLibrarianSubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

$('input[name="edit_contactNumber"]').on('input', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});

function toggleInactive(userId) {

    let url = "{{ route('admin.manage_librarians.toggle', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
    title: "Toggle Inactive?",
    text: "Do you want to mark this librarian as Inactive?",
    icon: "question",
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, toggle it!"
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Toggling Active Librarian...',
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
                type: 'GET',
                success: function(response) {
                    if(response.status == 'success'){
                        Swal.fire({
                            title: "Success!",
                            text: "Librarian toggled successfully!",
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

function viewInactiveLibrarian() {
    Swal.fire({
        title: 'Fetching Inactive Librarians...',
        text: 'Please wait for a while.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });

    let url = "{{ route('admin.manage_librarians.inactive') }}";

    $.ajax({
        url: url,
        type: 'GET',
        success: function(response) {
            Swal.close();

            let tbody = '';

            response.forEach(item => {
                let avatar = item.profile_picture
                    ? `/storage/${item.profile_picture}`
                    : `{{ asset('assets/images/default_profile.jpg') }}`;

                let fullName = `${item.first_name} ${item.middle_name ? item.middle_name.charAt(0).toUpperCase() + '.' : ''} ${item.last_name} ${item.suffix ?? ''}`;

                tbody += `
                    <tr>
                        <td>${item.librarian_code}</td>
                        <td>
                            <div class="row">
                                <div class="col-2">
                                    <span class="avatar avatar-md" style="background-image: url('${avatar}')"></span>
                                </div>
                                <div class="col-10 text-start d-flex flex-column">
                                    <div class="fw-bold">${fullName}</div>
                                    <div>${item.user.email}</div>
                                </div>
                            </div>
                        </td>
                        <td>${item.gender ?? ''}</td>
                        <td>
                            <div class="btn-actions d-flex justify-content-center align-items-center">
                                <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Toggle Ative" onclick="toggleActive(${item.user.id})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4" />
                                        <path d="M15 19l2 2l4 -4" />
                                    </svg>
                                </button>

                                <button class="btn btn-action" title="Delete" onclick="deleteLibrarian(${item.user.id})">
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
                `;
            });

            $('#inactiveLibrarianTbody').html(tbody);

            $('#view-inactive-librarian-modal').modal('show');

            // Re-init DataTable safely
            if ($.fn.DataTable.isDataTable('#inactiveLibrarianTable')) {
                $('#inactiveLibrarianTable').DataTable().destroy();
            }

            $('#inactiveLibrarianTable').DataTable({
                columnDefs: [
                    {
                        className: "dt-center",
                        targets: "_all"
                    },
                    {
                        targets: [-1],
                        searchable: false,
                        orderable: false,
                    }
                ],
                order: [[0, "desc"]],
                paging: true,
                searching: true,
                ordering: true,
                responsive: true,
            });
        },
        error: function() {
            Swal.close();
            toastr.error('Something went wrong', 'Internal Server Error');
        }
    });
}

function toggleActive(userId) {

    let url = "{{ route('admin.manage_librarians.toggle', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
    title: "Toggle Active?",
    text: "Do you want to mark this librarian as Active?",
    icon: "question",
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCancelButton: true,
    confirmButtonColor: "#88dd33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Yes, toggle it!"
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Toggling Inactive Librarian...',
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
                type: 'GET',
                success: function(response) {
                    if(response.status == 'success'){
                        Swal.fire({
                            title: "Success!",
                            text: "Librarian toggled successfully!",
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

function deleteLibrarian(userId) {

    let url = "{{ route('admin.manage_librarians.delete', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
    title: "Delete Librarian Permanently?",
    text: "This cannot be undone and access anymore.",
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
                title: 'Deleting Librarian...',
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
                            text: "Librarian Deleted successfully!",
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