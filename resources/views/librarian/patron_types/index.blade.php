@extends('master.librarian_master')
@section('librarian')
@include('librarian.patron_types.modal.patron_types_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Patron Types</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addPatronType()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Patron Types
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="patronTypesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Added by</th>
                        <th>Max Books</th>
                        <th>Borrow Days</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($patronTypes)
                        @foreach ($patronTypes as $item)
                            <tr>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->description}}</td>
                                <td>{{ $item->addedBy->name}}</td>
                                <td>{{ $item->max_books}}</td>
                                <td>{{ $item->borrow_days}}</td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editPatronTypes({{$item->id}}, `{{$item->name}}`, `{{ $item->description}}`, {{ $item->max_books}}, {{ $item->borrow_days}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deletePatronTypes({{$item->id}})">
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
    $('#patronTypesTable').DataTable({
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

    $('input[name="maxBooks"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('input[name="borrowDays"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('input[name="edit_maxBooks"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('input[name="edit_borrowDays"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    // CSRF TOKEN
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
</script>
<script>
function addPatronType() {
    $('#addPatronTypeForm')[0].reset();
    $('#add-patronTypes-modal').modal('show');
}

$('#addPatronTypeForm').validate({

    rules: {

        name: {
            required: true
        },

        description: {
            required: true
        },

        maxBooks: {
            required: true
        },

        borrowDays: {
            required: true
        }
    },

    messages: {

        name: {
            required: "Name is required"
        },

        description: {
            required: "Description is required"
        },

        maxBooks: {
            required: "Max Books is required"
        },

        borrowDays: {
            required: "Borrow Days is required"
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
        title: "Add Patron Type?",
        text: "This will add to the records",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, add Patron Type!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#addPatronTypeSubmit').text('Submitting...')
                $('#addPatronTypeSubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

function editPatronTypes(id, name, description, maxBooks, borrowDays) {
    $('#editPatronTypeForm')[0].reset();

    $('#patron_type_id').val(id);
    $('#edit_name').val(name);
    $('#edit_description').val(description);
    $('#edit_maxBooks').val(maxBooks);
    $('#edit_borrowDays').val(borrowDays);

    $('#edit-patronTypes-modal').modal('show');
}

$('#editPatronTypeForm').validate({

    rules: {

        edit_name: {
            required: true
        },

        edit_description: {
            required: true
        },

        edit_maxBooks: {
            required: true
        },

        edit_borrowDays: {
            required: true
        }
    },

    messages: {

        edit_name: {
            required: "Name is required"
        },

        edit_description: {
            required: "Description is required"
        },

        edit_maxBooks: {
            required: "Max Books is required"
        },

        edit_borrowDays: {
            required: "Borrow Days is required"
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
        title: "Update Patron Type?",
        text: "This will update to the records",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, update Patron Type!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#updatePatronTypeSubmit').text('Submitting...')
                $('#updatePatronTypeSubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

function deletePatronTypes(id) {

    let url = "{{ route('librarian.patronType.delete', ':id')}}";
    url = url.replace(':id', id);

    Swal.fire({
    title: "Delete Patron Type?",
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
                title: 'Deleting Patron Type...',
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
                    else {
                        Swal.fire({
                            title: "Conflict!",
                            text: response.text,
                            icon: "error"
                        })
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