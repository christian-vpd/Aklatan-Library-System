<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aklatan | Log In</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler/tabler.min.css') }}">
    <style>
        @font-face {
            font-family: interVariable;
            src: url('{{ asset('assets/fonts/InterVariable.woff2') }}') format('woff2');
        }

        * {
            font-family: 'InterVariable', sans-serif;
        }

        ul {
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ route('index') }}">
                <img src="{{ asset('assets/images/favicon.ico') }}" alt="Icons">
            </a>
        </div>
        <div class="card card-md">
          <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>
            <form id="loginForm" action="{{ route('login.submit') }}" method="post" autocomplete="off" novalidate="">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li class="text-danger">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
              @csrf
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Your username" autocomplete="off" maxlength="20">
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                  <span class="form-label-description">
                    <a href="#">I forgot password</a>
                  </span>
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control" name="password" id="password" placeholder="Your password" autocomplete="off" maxlength="20">
                  <span class="input-group-text" style="cursor: pointer;">
                    <a onclick="showPassword()" class="link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password"><!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                        <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg></a>
                  </span>
                </div>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100" id="loginBtn">Log in</button>
              </div>
            </form>
          </div>
        </div>
        <div class="text-center text-secondary mt-3">For new users, please coordinate with the Librarian on duty.</div>
      </div>
    </div>
</body>
<script src="{{ asset('assets/js/tabler/tabler.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#loginForm').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },

            messages: {
                username: {
                    required: 'Please enter your username',
                    minlength: 'Username must be at least 3 characters'
                },
                password: {
                    required: 'Please enter your password',
                    minlength: 'Password must be at least 6 characters'
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

                // disable button
                $('#loginBtn').prop('disabled', true).text('Logging in...');

                form.submit();
            }
        });
    });

    // Toggle Show Password
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type == 'password') {
            x.type = 'text';
        }
        else {
            x.type = 'password';
        }
    }
</script>
</html>