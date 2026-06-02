@extends('master.librarian_master')
@section('librarian')
@include('librarian.patron.modal.patron_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Patrons</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addPatron()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Patron
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
            <form action="{{ route('librarian.patron.filter') }}" method="GET" id="patronFilterForm">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                        <p class="form-label">Gender</p>
                        <select class="form-select" name="filter_gender">
                            <option value="">Select Gender</option>
                            <option value="Male" {{ request('filter_gender') == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>
                            <option value="Female" {{ request('filter_gender') == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                        <p class="form-label">Patron Type</p>
                        <select class="form-select" name="filter_patron_type_id">
                            <option value="">Select Patron Type</option>
                            @foreach ($patronType as $item)
                                <option value="{{ $item->id }}" {{ request('filter_patron_type_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2">
                        <p class="form-label">Status</p>
                        <select class="form-select" name="filter_status">
                            <option value="">Select Status</option>
                            <option value="active"
                                {{ request('filter_status') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="inactive"
                                {{ request('filter_status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>
                            <option value="suspended"
                                {{ request('filter_status') == 'suspended' ? 'selected' : '' }}>
                                Suspended
                            </option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-info btn-5" onclick="$(this).prop('disabled', true); $('#patronFilterForm').submit();">
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
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="patronTable">
                <thead>
                    <tr>
                        <th>Patron Code</th>
                        <th>Profile</th>
                        <th>Gender</th>
                        <th>Patron Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($patrons)
                        @foreach ($patrons as $item)
                        <tr>
                            <td>{{ $item->patron_code}}</td>
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
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->type->name }}</td>
                            <td>
                                @php
                                    $status = Str::ucfirst($item->user->status);
                                @endphp
                                <span class="badge {{$status == 'Active' ? 'bg-success text-success-fg' : 'bg-danger text-danger-fg' }}">{{$status}}</span>
                            </td>
                            <td>
                                <div class="btn-actions d-flex justify-content-center align-items-center">
                                    <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editPatron({{$item->user->id}})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                        <path d="M16 5l3 3"></path>
                                        </svg>
                                    </button>
                                    <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deletePatron({{$item->user->id}})">
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
    $('#patronTable').DataTable({
        "columnDefs": [
            {
                "className": "dt-center",
                "targets": "_all"
            },
            {
                "orderable": false,
                "targets": [-1],
            },
        ],
        "order": [[ 0, "desc"]],
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

    // Numbers Only
    $('input[name="contactNumber"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('input[name="edit_contactNumber"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
<script>
    function addPatron() {
        $('#addPatronForm')[0].reset();
        $('#add-patron-modal').modal('show');
    }

    $('#addPatronForm').validate({

        rules: {

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
                    url: "{{ route('librarian.patron.checkEmail') }}",
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
            },

            patronType: {
                required: true
            },
        },

        messages: {

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
            },

            patronType: {
                required: "Please select Patron Type"
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
            title: "Add Patron?",
            text: "You won't be able to revert this!",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add Patron!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addPatronSubmit').text('Submitting...')
                    $('#addPatronSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function editPatron(userId) {

        let url = "{{ route('librarian.patron.edit', ':id')}}";
        url = url.replace(':id', userId);

        Swal.fire({
            title: 'Getting Patron information!',
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
                $('#editPatronForm')[0].reset();
                $('#edit_user_id').val(response.id);
                $('#edit_lastName').val(response.patron.last_name);
                $('#edit_firstName').val(response.patron.first_name);
                $('#edit_middleName').val(response.patron.middle_name);
                $('#edit_suffix').val(response.patron.suffix);
                $('#edit_contactNumber').val(response.patron.contact_number);
                $('#edit_email').val(response.email);
                $('#edit_gender').val(response.patron.gender);
                $('#edit_patronType').val(response.patron.patron_type_id);
                $('#edit_status').val(response.status);
                $('#edit-patron-modal').modal('show');
            },
            error: function(xhr) {
                Swal.close();
                toastr.error('Something went wrong', 'Internal Server Error');
            }
        });
    }

    $('#editPatronForm').validate({

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
                    url: "{{ route('librarian.patron.checkEmail') }}",
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
            },

            edit_patronType: {
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
            },

            edit_patronType: {
                required: "Please select patron type"
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
            title: "Update Patron?",
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
                    $('#editPatronSubmit').text('Submitting...')
                    $('#editPatronSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deletePatron(userId) {

        let url = "{{ route('librarian.patron.delete', ':id')}}";
        url = url.replace(':id', userId);

        Swal.fire({
        title: "Delete Patron Permanently?",
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
                    title: 'Deleting Patron...',
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
                                text: "Patron Deleted successfully!",
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

    // Filter Section
</script>
@endsection