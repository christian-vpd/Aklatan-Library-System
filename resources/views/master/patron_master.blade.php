<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aklatan | Patrons</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/toastr/toastr.css') }}">

    {{-- Pre Defined Scripts --}}
    <script src="{{ asset('assets/js/tabler/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/libs/toastr/toastr.min.js') }}"></script>
</head>
<body>
    <div class="page">
      <!-- BEGIN NAVBAR  -->
      <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
          <!-- BEGIN NAVBAR TOGGLER -->
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- END NAVBAR TOGGLER -->
          <!-- BEGIN NAVBAR LOGO -->
          <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="{{ route('patron.dashboard') }}" aria-label="Icon">
                <img src="{{ asset('assets/images/favicon.ico') }}" alt="Icon" width="30">
            </a>
          </div>
          <!-- END NAVBAR LOGO -->
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
                @php
                    $profilePicture = Auth::user()->patron->profile_picture;

                    $avatar = asset('assets/images/default_profile.jpg');

                    if (!empty($profilePicture) && Storage::disk('public')->exists($profilePicture)) {
                        $avatar = Storage::url($profilePicture);
                    }
                @endphp

                <span class="avatar avatar-sm"
                    style="background-image: url('{{ $avatar }}')">
                </span>

                <div class="d-none d-xl-block ps-2">
                  <div>{{ Auth::user()->patron->first_name}} {{ Auth::user()->patron->last_name}}</div>
                  <div class="mt-1 small text-secondary">{{ Auth::user()->patron->type->name}}</div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <a href="#" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logoutForm').submit();">
                        Logout
                    </a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </header>
      <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar">
            <div class="container-xl">
              <div class="row flex-column flex-md-row flex-fill align-items-center">
                <div class="col">
                  <!-- BEGIN NAVBAR MENU -->
                  <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('patron.dashboard') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 5a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1l0 -10" />
                                <path d="M7 20l10 0" />
                                <path d="M9 16l0 4" />
                                <path d="M15 16l0 4" />
                                <path d="M8 12l3 -3l2 2l3 -3" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Dashboard </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                          <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                          <path d="M3 6l0 13" />
                          <path d="M12 6l0 13" />
                          <path d="M21 6l0 13" />
                        </svg>
                        <span class="nav-link-title"> Browse </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-book-2">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M19 4v16h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12" />
                          <path d="M19 16h-12a2 2 0 0 0 -2 2" />
                          <path d="M9 8h6" />
                        </svg>
                        <span class="nav-link-title"> Borrows </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-reserved-line">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M9 20h6" />
                          <path d="M12 14v6" />
                          <path d="M4 6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2l0 -6" />
                          <path d="M9 9h6" />
                        </svg>
                        <span class="nav-link-title"> Reservations </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-dollar">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                          <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" />
                          <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                          <path d="M12 17v1m0 -8v1" />
                        </svg>
                        <span class="nav-link-title"> Fines </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('patron.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-checklist"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8" /><path d="M14 19l2 2l4 -4" /><path d="M9 8h4" /><path d="M9 12h2" /></svg>
                        </span>
                        <span class="nav-link-title"> Policies </span>
                      </a>
                    </li>
                  </ul>
                  <!-- END NAVBAR MENU -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </header>
      <!-- END NAVBAR  -->
      <div class="page-wrapper">
        <!-- BEGIN PAGE HEADER -->
        {{-- <div class="page-header d-print-none" aria-label="Page header">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <h2 class="page-title">Empty page</h2>
              </div>
            </div>
          </div>
        </div> --}}
        <!-- END PAGE HEADER -->
        <!-- BEGIN PAGE BODY -->
        <div class="page-body">
          <div class="container-xl">
            <!-- Content here -->
            @yield('patron')
          </div>
        </div>
        <!-- END PAGE BODY -->
        <!--  BEGIN FOOTER  -->
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">Created by PapiChans</li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Aklatan 2026
                  </li>
                  <li class="list-inline-item">
                    Internal Library System
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
        <!--  END FOOTER  -->
      </div>
    </div>
</body>
@if (session('notification'))
    <script>
        toastr["{{ session('notification')['alert_type'] }}"](
            "{{ session('notification')['message'] }}",
            "{{ session('notification')['title'] }}"
        );
    </script>
@endif
</html>