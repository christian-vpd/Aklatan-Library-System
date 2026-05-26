@extends('master.admin_master')
@section('admin')
@include('admin.library_hours.modal.library_hours_modal')
<link rel="stylesheet" href="{{ asset('assets/libs/datatables/dataTables.min.css') }}">
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Admin</div>
            <h2 class="page-title">Library Hours</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="libraryHoursTable">
                <thead>
                    <tr>
                        <th>Day</th>
                        <th>Open Time</th>
                        <th>Close Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($days)
                        @foreach ($days as $item)
                            @php
                                // Check if the item's day matches the current system day name
                                $isToday = strtolower($item->day) === strtolower(now()->format('l'));
                            @endphp
                            <tr class="{{ $isToday ? 'bg-light text-primary' : ''}}">
                                <td class="fw-bold">{{ $item->day }}</td>
                                @if ($item->is_closed)
                                    <td><span class="badge bg-danger text-danger-fg">Closed</span></td>
                                    <td><span class="badge bg-danger text-danger-fg">Closed</span></td>
                                @else
                                    <td>{{ \Carbon\Carbon::parse($item->open_time)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->close_time)->format('h:i A') }}</td>
                                @endif
                                <td>
                                    <div class="btn-actions d-flex justify-content-center align-items-center">
                                        <button class="btn btn-action" data-toggle="tooltip" data-placement="top" title="Edit" onclick="editLibraryHours({{ $item->id }}, '{{ $item->open_time }}', '{{ $item->close_time }}', {{ $item->is_closed }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                            <path d="M16 5l3 3"></path>
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
    $('#libraryHoursTable').DataTable({
        "columnDefs": [
            {
                "className": "dt-center",
                "targets": "_all"
            },
        ],
        "order": [[ 0, "desc"]],
        paging: false,
        searching: false,
        ordering: false,
        responsive: true,
    });

    // Tooltip
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
});

function editLibraryHours(id, open_time, close_time, is_closed) {
    $('#editHourForm')[0].reset();
    // Appending Values
    $('#hourId').val(id);
    if (is_closed) {
        $('#close').prop('checked', true);
        $('#opening_hours').prop('disabled', true);
        $('#closing_hours').prop('disabled', true);
    }
    else {
        $('#opening_hours').prop('disabled', false);
        $('#closing_hours').prop('disabled', false);
        $('#opening_hours').val(open_time);
        $('#closing_hours').val(close_time);
    }

    $('#edit-libraryHours-modal').modal('show');
}

// Change Function Toggle
$('#close').change(function () {
    const isDisabled = $(this).is(':checked');

    // Toggle disabled state
    $('#opening_hours, #closing_hours').prop('disabled', isDisabled);
    
    // Toggle required attribute
    $('#opening_hours, #closing_hours').prop('required', !isDisabled);

    if (isDisabled) {
        $('#opening_hours, #closing_hours').val(null);
        $('#opening_hours, #closing_hours').removeClass('is-invalid'); 
    }
});


// Validate
$('#editHourForm').validate({
    rules: {
        opening_hours: {
            required: function () {
                return !$('#close').is(':checked');
            }
        },

        closing_hours: {
            required: function () {
                return !$('#close').is(':checked');
            }
        },
    },

    messages: {
        opening_hours: {
            required: "Opening hours is required"
        },

        closing_hours: {
            required: "Closing hours is required"
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
        title: "Update Library hours?",
        text: "This will update the table.",
        icon: "question",
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        confirmButtonColor: "#88dd33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, update it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $('#editHourSubmit').text('Updating...')
                $('#editHourSubmit').prop('disabled', true)
                form.submit();
            }
        });
    }
});

</script>
@endsection