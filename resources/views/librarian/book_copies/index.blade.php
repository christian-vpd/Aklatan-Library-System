@extends('master.librarian_master')
@section('librarian')
@include('librarian.book_copies.modal.book_copies_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Book Copies</h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <button class="btn btn-primary btn-5" onclick="addCopy()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Add Book Copy
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Book Information</h3>
        </div>
        <div class="card-body">
            <div class="row d-flex text-start">
                <div class="col-12">
                    <div class="fs-3 fw-bold">{{$book->title}}</div>
                    <p class="fs-4 fw-normal">{{$book->description}}</p>
                    <div class="fs-5 fw-bold">ISBN: <span class="fw-normal">{{$book->isbn}}</span></div>
                    <div class="fs-5 fw-bold">Publisher: <span class="fw-normal">{{$book->publisher}} ({{$book->publication_year}})</span></div>
                    <div class="fs-5 fw-bold">Author/s:
                        @if ($book->bookAuthor->count())
                            <span class="fst-italic fw-normal">
                                @foreach ($book->bookAuthor as $bookAuthor)
                                    {{ $bookAuthor->authors->name }}@if(!$loop->last), @endif
                                @endforeach
                            </span>
                        @endif
                    </div>
                    <div class="fs-5 fw-bold">Category: <span class="fw-normal badge bg-primary text-primary-fg">{{$book->category->name}}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="bookCopiesTable">
                <thead>
                    <tr>
                        <th>Ascension Number</th>
                        <th>Barcode</th>
                        <th>Status</th>
                        <th>Condition</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($book->copies)
                        @foreach ($book->copies as $item)
                            <tr>
                                <td>{{$item->ascension_number}}</td>
                                <td>{{$item->barcode}}</td>
                                <td>
                                    @switch($item->status)
                                        @case('available')
                                            <span class="badge bg-success text-success-fg">Available</span>
                                        @break
                                        @case('borrowed')
                                            <span class="badge bg-info text-info-fg">Borrowed</span>
                                        @break
                                        @case('damaged')
                                            <span class="badge bg-orange text-orange-fg">Damaged</span>
                                        @case('lost')
                                            <span class="badge bg-purple text-purple-fg">Lost</span>
                                        @break
                                        @case('reserved')
                                            <span class="badge bg-primary text-primary-fg">Reserved</span>
                                        @break
                                        @default
                                            <span class="badge bg-dark text-dark-fg">Unknown</span>                                         
                                    @endswitch
                                </td>
                                <td>
                                    @switch($item->condition)
                                        @case('good')
                                            <span class="badge bg-primary text-primary-fg">Good</span>
                                        @break
                                        @case('fair')
                                            <span class="badge bg-orange text-orange-fg">Fair</span>
                                        @break
                                        @case('new')
                                            <span class="badge bg-success text-success-fg">New</span>
                                        @break
                                        @case('poor')
                                            <span class="badge bg-danger text-danger-fg">Poor</span>
                                        @break
                                        @default
                                            <span class="badge bg-dark text-dark-fg">Unknown</span> 
                                    @endswitch
                                </td>
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editCopy({{$item->id}}, `{{$item->barcode}}`, `{{$item->condition}}`)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
                                            </svg>
                                        </button>
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Delete" onclick="deleteCopy({{$item->id}})">
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
        $('#bookCopiesTable').DataTable({
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
    function addCopy() {
        $('#addBookCopyForm')[0].reset();
        $('#add-bookCopies-modal').modal('show');
    }   

    $('#addBookCopyForm').validate({

        rules: {

            barcode: {
                required: true,

                remote: {
                    url: "{{ route('librarian.bookCopies.checkBarcode') }}",
                    type: "POST",
                    data: {
                        barcode: function () {
                            return $('#barcode').val();
                        },
                        _token: "{{ csrf_token() }}"
                    }
                }
            },

            condition: {
                required: true
            },

        },

        messages: {

            barcode: {
                required: "Barcode is required",
                remote: "Barcode already exists.",
            },

            condition: {
                required: "Condition is required"
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
            title: "Add Book Copy?",
            text: "This will add to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, add it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#addBookCopySubmit').text('Submitting...')
                    $('#addBookCopySubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function editCopy(id, barcode, condition) {
        $('#editBookCopyForm')[0].reset();
        $('#edit_book_copy_id').val(id);
        $('#edit_barcode').val(barcode);
        $('#edit_condition').val(condition);
        $('#edit-bookCopies-modal').modal('show');
    }

    $('#editBookCopyForm').validate({

        rules: {

            edit_barcode: {
                required: true,

                remote: {
                    url: "{{ route('librarian.bookCopies.checkBarcode') }}",
                    type: "POST",
                    data: {
                        barcode: function () {
                            return $('#edit_barcode').val();
                        },
                        id: function () {
                            return $('#edit_book_copy_id').val();
                        },
                        _token: "{{ csrf_token() }}"
                    }
                },
            },

            edit_condition: {
                required: true
            },

        },

        messages: {

            edit_barcode: {
                required: "Barcode is required",
                remote: "Barcode already exists.",
            },

            edit_condition: {
                required: "Condition is required"
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
            title: "Edit Book Copy?",
            text: "This will update to the records",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, update it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#editBookCopySubmit').text('Submitting...')
                    $('#editBookCopySubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    function deleteCopy(id) {

        let url = "{{ route('librarian.bookCopies.delete', ':id')}}";
        url = url.replace(':id', id);

        Swal.fire({
        title: "Delete Copy?",
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
                    title: 'Deleting Copy...',
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
                                text: "Book Copy deleted successfully!",
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