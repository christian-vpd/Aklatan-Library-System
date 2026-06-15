@extends('master.librarian_master')
@section('librarian')
@include('librarian.categories.modal.categories_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Book Categories</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addCategory()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Category
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="categoriesTable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($categories)
                        @foreach ($categories as $item)
                            <tr>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->description}}</td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editCategory({{$item->id}}, `{{$item->name}}`, `{{ $item->description}}`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteCategory({{$item->id}})">
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
    $(document).ready(function () {
        $('#categoriesTable').DataTable({
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
</script>
<script>
    function addCategory() {
        $('#addCategoryForm')[0].reset();
        $('#add-categories-modal').modal('show');
    }

    $('#addCategoryForm').validate({

        rules: {

            name: {
                required: true
            },

            description: {
                required: true
            },
        },

        messages: {

            name: {
                required: "Name is required"
            },

            description: {
                required: "Description is required"
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
            title: "Add Category?",
            text: "This will add to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add Category!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addCategorySubmit').text('Submitting...')
                    $('#addCategorySubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

     function editCategory(id, name, description) {
        $('#editCategoryForm')[0].reset();

        $('#edit_category_id').val(id);
        $('#edit_name').val(name);
        $('#edit_description').val(description);

        $('#edit-categories-modal').modal('show');
    }

    $('#editCategoryForm').validate({

        rules: {

            edit_name: {
                required: true
            },

            edit_description: {
                required: true
            },
        },

        messages: {

            edit_name: {
                required: "Name is required"
            },

            edit_description: {
                required: "Description is required"
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
            title: "Update Category?",
            text: "This will update to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, update Category!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#editCategorySubmit').text('Submitting...')
                    $('#editCategorySubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deleteCategory(id) {

        let url = "{{ route('librarian.category.delete', ':id')}}";
        url = url.replace(':id', id);

        Swal.fire({
        title: "Delete Category?",
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
                    title: 'Deleting Category Type...',
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
                                text: "Category deleted successfully!",
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