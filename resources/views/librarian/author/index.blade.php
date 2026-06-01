@extends('master.librarian_master')
@section('librarian')
@include('librarian.author.modal.author_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Authors</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5 d-none d-sm-inline-block" onclick="addAuthor()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Authors
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="authorTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date Added</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($author)
                        @foreach ($author as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->created_at?->format('F j, Y') }}</td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editAuthor({{$item->id}}, `{{$item->name}}`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteAuthor({{$item->id}})">
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
    $('#authorTable').DataTable({
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
    function addAuthor() {
        $('#addAuthorForm')[0].reset();
        $('#add-author-modal').modal('show');
    }

    $('#addAuthorForm').validate({

        rules: {

            name: {
                required: true
            },

        },

        messages: {

            name: {
                required: "Name is required"
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
            title: "Add Author?",
            text: "This will add to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add Author!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addAuthorSubmit').text('Submitting...')
                    $('#addAuthorSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function editAuthor(id, name) {
        $('#editAuthorForm')[0].reset();
        $('#edit_author_id').val(id);
        $('#edit_name').val(name);
        $('#edit-author-modal').modal('show');
    }

    $('#editAuthorForm').validate({

        rules: {

            edit_name: {
                required: true
            },

        },

        messages: {

            edit_name: {
                required: "Name is required"
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
            title: "Update Author?",
            text: "This will update to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, update Author!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#editAuthorSubmit').text('Updating...')
                    $('#editAuthorSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deleteAuthor(id) {

        let url = "{{ route('librarian.author.delete', ':id')}}";
        url = url.replace(':id', id);

        Swal.fire({
        title: "Delete Author?",
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
                    title: 'Deleting Author...',
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
                                text: "Author Deleted successfully!",
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