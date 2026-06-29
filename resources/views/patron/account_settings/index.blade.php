@extends('master.patron_master')
@section('patron')
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
            <div class="page-pretitle">Librarian</div>
            <h2 class="page-title">Account Settings</h2>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                <a href="#tabs-account" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Personal Information</a>
                </li>
                <li class="nav-item" role="presentation">
                <a href="#tabs-changes-pass" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Change Password</a>
                </li>
            </ul>
        </div>
        <div class="card-body border-bottom py-3">
            <div class="tab-content">
                <div class="tab-pane active show" id="tabs-account" role="tabpanel">
                    <div class="alert alert-info" role="alert">
                        <div class="alert-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                        </svg>
                        </div>
                        Ensure that the information provided was correct and accurate.
                    </div>
                    <form method="POST" action="{{ route('patron.account_settings.update') }}" id="changePersonalInfoForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="personal_user_id" id="personal_user_id" value="{{ $user->id}}">
                        <div class="col-12">
                            <p class="fw-bold">Patron Code: &nbsp; <span class="fw-normal">{{ $user->patron->patron_code}}</span></p>
                        </div>
                        <h2 class="fw-bold text-info">Patron Name</h2>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-sm-6 mb-2">
                                <label class="form-label required">Last Name</label>
                                <input type="text" class="form-control" name="lastName" placeholder="Last Name" maxlength="20" value="{{ $user->patron->last_name }}">
                            </div>
                            <div class="col-12 col-md-3 col-sm-6 mb-2">
                                <label class="form-label required">First Name</label>
                                <input type="text" class="form-control" name="firstName" placeholder="First Name" maxlength="20" value="{{ $user->patron->first_name }}">
                            </div>
                            <div class="col-12 col-md-3 col-sm-6 mb-2">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" name="middleName" placeholder="Middle Name" maxlength="20" value="{{ $user->patron->middle_name }}">
                            </div>
                            <div class="col-12 col-md-3 col-sm-6 mb-2"> 
                                <label class="form-label">Suffix</label> 
                                <select class="form-select" name="suffix"> 
                                    <option value="" @selected(old('suffix', $user->patron->suffix) == '')>No suffix</option> 
                                    <option value="Jr." @selected(old('suffix', $user->patron->suffix) == 'Jr.')>Jr.</option> 
                                    <option value="Sr." @selected(old('suffix', $user->patron->suffix) == 'Sr.')>Sr.</option> 
                                    <option value="I" @selected(old('suffix', $user->patron->suffix) == 'I')>I</option> 
                                    <option value="II" @selected(old('suffix', $user->patron->suffix) == 'II')>II</option> 
                                    <option value="III" @selected(old('suffix', $user->patron->suffix) == 'III')>III</option> 
                                    <option value="IV" @selected(old('suffix', $user->patron->suffix) == 'IV')>IV</option> 
                                </select> 
                            </div>
                        </div>
                        <h2 class="fw-bold text-info">Contact Information</h2>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-sm-6 mb-2">
                                <label class="form-label required">Contact Number</label>
                                <input type="text" name="contactNumber" class="form-control" data-mask="09123456789" data-mask-visible="true" placeholder="09123456789" autocomplete="off" maxlength="11" inputmode="numeric" pattern="[0-9]*" value="{{ $user->patron->contact_number }}">
                            </div>
                            <div class="col-12 col-md-6 col-sm-6 mb-2">
                                <label class="form-label required">Email Address</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" maxlength="30" value="{{ $user->email }}">
                            </div>
                        </div>
                        <h2 class="fw-bold text-info">Other Information</h2>
                        <div class="row mb-3">
                            <div class="col-12 col-md-3 col-sm-6 mb-2">
                                <label class="form-label required">Gender</label>
                                <select class="form-select" name="gender">
                                <option value="" selected disabled>Select Gender</option>
                                <option value="Male" @selected(old('suffix', $user->patron->gender) == 'Male')>Male</option>
                                <option value="Female" @selected(old('suffix', $user->patron->gender) == 'Female')>Female</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6 col-sm-6 mb-2">
                                <label class="form-label">Upload Profile Picture <small class="text-info fw-normal">(PNG and JPG only)</small></label>
                                <input type="file" class="form-control" accept="image/jpeg, image/png" name="profilePicture">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <button type="submit" class="btn btn-primary" id="updatePersonalSubmit">Update Information</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="tabs-changes-pass" role="tabpanel">
                    <div class="alert alert-info" role="alert">
                        <div class="alert-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                            <path d="M12 9h.01"></path>
                            <path d="M11 12h1v4h1"></path>
                        </svg>
                        </div>
                        Once you changed your password, you will automatically logged out.
                    </div>
                    <form method="POST" action="{{ route('patron.account_settings.changePassword') }}" id="changePasswordForm">
                        @csrf
                        <input type="hidden" name="change_user_id" id="change_user_id" value="{{ $user->id}}">
                        <div class="col-12">
                            <p class="fw-bold">Patron Code: &nbsp; <span class="fw-normal">{{ $user->patron->patron_code}}</span></p>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label required">Old Password</label>
                                <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="Your password" autocomplete="off" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label required">New Password</label>
                                <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="Your New password" autocomplete="off" maxlength="20">
                                    <span class="input-group-text" style="cursor: pointer;">
                                        <a onclick="showPassword()" class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg></a>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mb-2">
                                <label class="form-label required">Confirm New Password</label>
                                <div class="input-group input-group-flat">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm New password" autocomplete="off" maxlength="20">
                                    <span class="input-group-text" style="cursor: pointer;">
                                        <a onclick="showConfirmPassword()" class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            <button type="submit" class="btn btn-primary" id="changePasswordSubmit">Change Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
<script>
$(document).ready(function () {
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
});

// Toggle Show Password
function showPassword() {
    var x = document.getElementById("new_password");
    if (x.type == 'password') {
        x.type = 'text';
    }
    else {
        x.type = 'password';
    }
}

// Toggle Show Confirm Password
function showConfirmPassword() {
    var x = document.getElementById("confirm_password");
    if (x.type == 'password') {
        x.type = 'text';
    }
    else {
        x.type = 'password';
    }
}

$('#old_password, #new_password, #confirm_password').on(
    'copy paste cut dragstart contextmenu',
    function (e) {
        e.preventDefault();
    }
);
</script>
<script>
    $('#changePersonalInfoForm').validate({

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
                    url: "{{ route('patron.account_settings.checkEmail') }}",
                    type: "POST",
                    data: {
                        email: function () {
                            return $('#email').val();
                        },
                        user_id: function () {
                            return $('#personal_user_id').val();
                        },
                        _token: "{{ csrf_token() }}"
                    }
                }
            },

            gender: {
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
            title: "Update Information?",
            text: "Your information will be updated.",
            icon: "question",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showCancelButton: true,
            confirmButtonColor: "#88dd33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, update it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#updatePersonalSubmit').text('Submitting...')
                    $('#updatePersonalSubmit').prop('disabled', true)
                    form.submit();
                }
            });
        }
    });

    $('#changePasswordForm').validate({

        rules: {

            old_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },

            new_password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },

            confirm_password: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: '#new_password'
            }

        },

        messages: {

            old_password: {
                required: 'Please enter your old password',
                minlength: 'Password must be at least 6 characters',
                maxlength: 'Password cannot exceed 20 characters'
            },

            new_password: {
                required: 'Please enter your new password',
                minlength: 'Password must be at least 6 characters',
                maxlength: 'Password cannot exceed 20 characters'
            },

            confirm_password: {
                required: 'Please confirm your new password',
                minlength: 'Password must be at least 6 characters',
                maxlength: 'Password cannot exceed 20 characters',
                equalTo: 'Passwords do not match'
            }

        },

        errorElement: 'span',

        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-3, .mb-2').append(error);
        },

        highlight: function(element) {
            $(element).addClass('is-invalid');
        },

        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        },

        submitHandler: function(form) {

            Swal.fire({
                title: 'Change Password?',
                text: 'Your password will be updated.',
                icon: 'question',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showCancelButton: true,
                confirmButtonColor: '#88dd33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    $('#changePasswordSubmit').text('Submitting...').prop('disabled', true);

                    form.submit();
                }

            });

        }

    });
</script>
@endsection