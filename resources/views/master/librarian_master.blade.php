<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Aklatan | Librarian</title>
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
            <a href="{{ route('librarian.dashboard') }}" aria-label="Icon">
                <img src="{{ asset('assets/images/favicon.ico') }}" alt="Icon" width="30">
            </a>
          </div>
          <!-- END NAVBAR LOGO -->
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link d-flex lh-1 p-0 px-2" data-bs-toggle="dropdown" aria-label="Open user menu">
                @php
                    $profilePicture = Auth::user()->librarian->profile_picture;

                    $avatar = asset('assets/images/default_profile.jpg');

                    if (!empty($profilePicture) && Storage::disk('public')->exists($profilePicture)) {
                        $avatar = Storage::url($profilePicture);
                    }
                @endphp

                <span class="avatar avatar-sm"
                    style="background-image: url('{{ $avatar }}')">
                </span>

                <div class="d-none d-xl-block ps-2">
                  <div>{{ Auth::user()->librarian->first_name}} {{ Auth::user()->librarian->last_name}}</div>
                  <div class="mt-1 small text-secondary">Librarian</div>
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
                    <li class="nav-item {{ request()->routeIs('librarian.dashboard') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
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
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
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
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-api-book">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 1.006 -.5" />
                              <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                              <path d="M3 6v13" />
                              <path d="M12 6v13" />
                              <path d="M21 6v6" />
                              <path d="M17.001 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                              <path d="M19.001 15.5v1.5" />
                              <path d="M19.001 21v1.5" />
                              <path d="M22.032 17.25l-1.299 .75" />
                              <path d="M17.27 20l-1.3 .75" />
                              <path d="M15.97 17.25l1.3 .75" />
                              <path d="M20.733 20l1.3 .75" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Manage Books </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-edit">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h3.5" />
                              <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Authors </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                              <path d="M17.001 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                              <path d="M19.001 15.5v1.5" />
                              <path d="M19.001 21v1.5" />
                              <path d="M22.032 17.25l-1.299 .75" />
                              <path d="M17.27 20l-1.3 .75" />
                              <path d="M15.97 17.25l1.3 .75" />
                              <path d="M20.733 20l1.3 .75" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Patrons </span>
                      </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('librarian.patronTypes.*') ? 'active' : '' }}">
                      <a class="nav-link" href="{{ route('librarian.patronTypes.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-exclamation">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                              <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                              <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.008 .128" />
                              <path d="M19 16v3" />
                              <path d="M19 22v.01" />
                            </svg>
                        </span>
                        <span class="nav-link-title"> Patron Types </span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('librarian.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                            <path d="M18 14v4h4" />
                            <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                            <path d="M8 5a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2" />
                            <path d="M14 18a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M8 11h4" />
                            <path d="M8 15h3" />
                          </svg>
                        </span>
                        <span class="nav-link-title"> Reports </span>
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
            @yield('librarian')
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