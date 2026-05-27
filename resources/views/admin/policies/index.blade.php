@extends('master.admin_master')
@section('admin')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
@include('admin.policies.modal.categories_modal')
@include('admin.policies.modal.policies_modal')
<style>
    .category-scroll {
        max-height: 500px;
        overflow-y: auto;
    }
</style>
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Admin</div>
            <h2 class="page-title">Policies</h2>
        </div>
    </div>
    <div class="card">
        <div class="row g-0">
            <div class="col-12 col-md-3 border-end">
                <div class="card-body">
                    <h4 class="subheader">Categories</h4>
                    <div class="list-group list-group-transparent category-scroll">
                        @if ($categories)
                            @foreach ($categories as $item)
                                <a href="{{ route('admin.policies.category', $item->id) }}"
                                    class="list-group-item list-group-item-action d-flex align-items-center {{$selectedCategory?->id == $item->id ? 'active disabled' : ''}}"
                                >{{ $item->name }}</a>
                            @endforeach
                        @endif
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-primary btn-5 d-none d-sm-inline-block" onclick="addCategory()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Add Category
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-9 d-flex flex-column pt-3">
                <div class="container">
                    @if ($selectedCategory)
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-9 d-flex flex-column">
                                        <h3 class="card-title">{{ $selectedCategory->name }}</h3>
                                        <p>{{ $selectedCategory->description }}</p>
                                    </div>
                                    <div class="col-12 col-md-3 d-flex justify-content-center align-items-center">
                                        <button class="btn btn-primary mx-1" onclick="editCategory({{ $selectedCategory->id }}, `{{$selectedCategory->name}}`, `{{$selectedCategory->description}}`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn btn-danger mx-1" onclick="deleteCategory({{ $selectedCategory->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end align-items-center">
                            <button class="btn btn-info mx-1" onclick="addPolicy({{ $selectedCategory->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    Add Policy
                                </button>
                        </div>
                        <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="policiesTable">
                            <thead>
                                <tr>
                                    <th>Policies</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($selectedCategory->policies as $item)
                                    <tr>
                                        <td>
                                            <h3>
                                                {{ $item->title}}
                                            </h3>
                                            <p class="text-wrap">{{ $item->body}}</p>
                                            <div class="row">
                                                <div class="col-auto d-flex align-items-center">
                                                    @if ($item->is_active == 1)
                                                        <span class="badge bg-success text-success-fg">Active</span>
                                                    @else
                                                        <span class="badge bg-danger text-danger-fg">Inactive</span>
                                                    @endif
                                                </div>
                                                <div class="col-auto">
                                                    <div class="btn-actions d-flex justify-content-center align-items-start">
                                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editPolicy({{ $item->id }}, `{{ $item->title }}`, `{{ $item->body }}`, {{ $item->is_active }} )">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                            <path d="M16 5l3 3"></path>
                                                            </svg>
                                                        </button>
                                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deletePolicy({{ $item->id }})">
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
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="card bg-primary-lt">
                            <div class="card-body">
                                <h3 class="card-title text-center">Select Category First</h3>
                                <p class="text-secondary text-center">
                                    By clicking one Category, it will display all the policies associated to that category.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables/dataTables.responsive.js') }}"></script>
<script>
$(document).ready(function () {
    $('#policiesTable').DataTable({
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

});
</script>
<script>
// -----------------------------
//  CATEGORIES SECTION

function addCategory() {
    $('#addCategoryForm')[0].reset();
    $('#add-category-modal').modal('show');
}

$('#addCategoryForm').validate({
    rules: {
        name: {
           required: true,
        },

        description: {
            required: true,
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
        title: "Add Policy Category?",
        text: "This will add category.",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, add it!"
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
    $('#edit-category-modal').modal('show');
}

$('#editCategoryForm').validate({
    rules: {
        edit_name: {
           required: true,
        },

        edit_description: {
            required: true,
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
        title: "Update Policy Category?",
        text: "This will update category.",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, update it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#editCategorySubmit').text('Updating...')
                $('#editCategorySubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

function deleteCategory(userId) {

    let url = "{{ route('admin.policies.category.delete', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
    title: "Delete Policy Category?",
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
                title: 'Deleting Category...',
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
                            text: "Category Deleted successfully!",
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
<script>
// -----------------------------
//  POLICIES SECTION
// -----------------------------

function addPolicy(id) {
    $('#addPolicyForm')[0].reset();
    $('#policy_category_id').val(id);
    $('#add-policy-modal').modal('show');
}

$('#addPolicyForm').validate({
    rules: {
        title: {
           required: true,
        },

        body: {
            required: true,
        },
    },

    messages: {
        title: {
            required: "Title is required"
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
        title: "Add Policy?",
        text: "This will add policy to this category.",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, add it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#addPolicySubmit').text('Submitting...')
                $('#addPolicySubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

function editPolicy(id, title, body, is_active) {
    $('#editPolicyForm')[0].reset();
    $('#policy_id').val(id);
    $('#edit_title').val(title);
    $('#edit_body').val(body);

    if (is_active == 1) {
        $('#edit_is_active').prop('checked', true);
    }

    $('#edit-policy-modal').modal('show');
}

$('#editPolicyForm').validate({
    rules: {
        edit_title: {
           required: true,
        },

        edit_body: {
            required: true,
        },
    },

    messages: {
        edit_title: {
            required: "Title is required"
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
        title: "Update Policy?",
        text: "This will updates policy to this category.",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, update it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#editPolicySubmit').text('Submitting...')
                $('#editPolicySubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

function deletePolicy(userId) {

    let url = "{{ route('admin.policies.delete', ':id')}}";
    url = url.replace(':id', userId);

    Swal.fire({
    title: "Delete Policy?",
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
                title: 'Deleting Policy...',
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
                            text: "Policy Deleted successfully!",
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