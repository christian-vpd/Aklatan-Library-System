@extends('master.librarian_master')
@section('librarian')
@include('librarian.manage_books.modal.manage_books_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/tomselect/tom-select.css')}}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Manage Books</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addBook()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Book
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Search Filter</h3>
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
            <form action="{{ route('librarian.manageBooks.filter')}}" method="GET" id="bookFilterForm">
                <div class="row">
                    <div class="col-12 col-md-6 mb-2">
                        <p class="form-label">Search Book</p>
                        <input type="text" class="form-control" name="filter_keyword" placeholder="Enter Keyword" value="{{ request('filter_keyword') ?? ''}}" maxlength="50">
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 mb-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-info btn-5" onclick="$(this).prop('disabled', true); $('#bookFilterForm').submit();">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                <path d="M21 21l-6 -6" />
                            </svg>
                            Search
                        </button>
                        <a href="{{ route('librarian.manageBooks.index') }}">
                            <button type="button" class="btn btn-secondary btn-5 mx-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-rotate-clockwise">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4.05 11a8 8 0 1 1 .5 4m-.5 5v-5h5" />
                                </svg>
                                Reset
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="bookTable">
                <thead>
                    <tr>
                        <th>Book List</th>
                        <th>ISBN</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($books)
                        @foreach ($books as $item)
                            <tr>
                                <td>
                                    <div class="row d-flex text-start">
                                        <div class="col-12">
                                            <div class="fs-3 fw-bold">{{$item->title}}</div>
                                            <p class="fs-4 fw-normal">{{$item->description}}</p>
                                            <div class="fs-5 fw-bold">Publisher: <span class="fw-normal">{{$item->publisher}} ({{$item->publication_year}})</span></div>
                                            <div class="fs-5 fw-bold">Author/s:
                                                @if ($item->bookAuthor->count())
                                                    <span class="fst-italic fw-normal">
                                                        @foreach ($item->bookAuthor as $bookAuthor)
                                                            {{ $bookAuthor->authors->name }}@if(!$loop->last), @endif
                                                        @endforeach
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="fs-5 fw-bold">Category: <span class="fw-normal badge bg-primary text-primary-fg">{{$item->category->name}}</span></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$item->isbn}}</td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <a href="{{route('librarian.bookCopies.index', $item->id)}}" target="_blank">
                                            <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="View Copies">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                </svg>
                                            </button>
                                        </a>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editBook({{$item->id}})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteBook({{$item->id}})">
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
<script src="{{ asset('assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/libs/tomselect/tom-select.complete.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('#bookTable').DataTable({
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

    // Date Pickr
    $('#year_published').datepicker({
        format: "yyyy",
        minViewMode: 2,
        maxViewMode: 2,
        autoclose: true,
        endDate: new Date(),
    });

    $('#edit_year_published').datepicker({
        format: "yyyy",
        minViewMode: 2,
        maxViewMode: 2,
        autoclose: true,
        endDate: new Date(),
    });

    // Selectors
    new TomSelect("#authors", {
        create: false,
        maxItems: 5,
        plugins: ['remove_button']
    });

    new TomSelect("#category", {
        create: false,
        plugins: ['remove_button']
    });

    new TomSelect("#edit_authors", {
        create: false,
        maxItems: 5,
        plugins: ['remove_button']
    });

    new TomSelect("#edit_category", {
        create: false,
        plugins: ['remove_button']
    });

    // Numbers Only
    $('input[name="isbn"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });

    $('input[name="edit_isbn"]').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
});
</script>
<script>
    function addBook() {
        $('#addBookForm')[0].reset();
        $('#add-book-modal').modal('show');
    }

    $('#addBookForm').validate({

        rules: {

            isbn: {
                required: true
            },

            category: {
                required: true
            },

            title: {
                required: true
            },

            description: {
                required: true
            },

            "authors[]": {
                required: true,
                minlength: 1,
                maxlength: 5 
            },

            publisher: {
                required: true
            },

            year_published: {
                required: true
            },

        },

        messages: {

            isbn: {
                required: "ISBN is required"
            },

            category: {
                required: "Category is required"
            },

            title: {
                required: "Title is required"
            },

            description: {
                required: "Description is required"
            },

            "authors[]": {
                required: "Authors is required",
                minlength: "You must choose at least {0} options.",
                maxlength: "You cannot choose more than {0} options.",
            },

            publisher: {
                required: "Publisher is required"
            },

            year_published: {
                required: "Year is required"
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
            title: "Add Book?",
            text: "This will add to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add Book!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addBookSubmit').text('Submitting...')
                    $('#addBookSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function editBook(book_id) {

        let url = "{{ route('librarian.manageBooks.edit', ':id')}}";
        url = url.replace(':id', book_id);

        Swal.fire({
            title: 'Getting Book information!',
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

                $('#editBookForm')[0].reset();

                $('#edit_book_id').val(response.id);
                $('#edit_isbn').val(response.isbn);
                $('#edit_title').val(response.title);
                $('#edit_description').val(response.description);
                $('#edit_publisher').val(response.publisher);
                $('#edit_year_published').val(response.publication_year);

                // Category
                let categorySelect = document.getElementById('edit_category').tomselect;
                categorySelect.setValue(String(response.category_id));

                // Authors
                let authorIds = response.book_author.map(item => String(item.author_id));

                let authorSelect = document.getElementById('edit_authors').tomselect;
                authorSelect.clear();
                authorSelect.setValue(authorIds);

                $('#edit-book-modal').modal('show');
                Swal.close();
            },
            error: function(xhr) {
                Swal.close();
                toastr.error('Something went wrong', 'Internal Server Error');
            }
        });
    }

    $('#editBookForm').validate({

        rules: {

            edit_isbn: {
                required: true
            },

            edit_category: {
                required: true
            },

            edit_title: {
                required: true
            },

            edit_description: {
                required: true
            },

            "edit_authors[]": {
                required: true,
                minlength: 1,
                maxlength: 5 
            },

            edit_publisher: {
                required: true
            },

            edit_year_published: {
                required: true
            },

        },

        messages: {

            edit_isbn: {
                required: "ISBN is required"
            },

            edit_category: {
                required: "Category is required"
            },

            edit_title: {
                required: "Title is required"
            },

            edit_description: {
                required: "Description is required"
            },

            "edit_authors[]": {
                required: "Authors is required",
                minlength: "You must choose at least {0} options.",
                maxlength: "You cannot choose more than {0} options.",
            },

            edit_publisher: {
                required: "Publisher is required"
            },

            edit_year_published: {
                required: "Year is required"
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
            title: "Update Book?",
            text: "This will Update to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, update Book!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#editBookSubmit').text('Submitting...')
                    $('#editBookSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deleteBook(id) {

        let url = "{{ route('librarian.manageBooks.delete', ':id')}}";
        url = url.replace(':id', id);

        Swal.fire({
        title: "Delete Book?",
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
                    title: 'Deleting Book...',
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
                                text: "Book deleted successfully!",
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