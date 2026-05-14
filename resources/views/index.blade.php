<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Aklatan | Library System</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/landsay/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landsay/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landsay/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landsay/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/landsay/default.css') }}">
</head>
<style>
    #home {
    position: relative;
    min-height: 100vh;
}

.library-background {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: -2;
}

.bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: -1;
}
body {
    overflow-x: hidden;
}

.price-box {
    min-height: 535px;
    max-height: 535px;
}

</style>
<body data-bs-spy="scroll" data-bs-target="#navbar-navlist" data-bs-offset="60">

        <!-- START NAVBAR -->
        <nav id="navbar" class="navbar navbar-expand-lg fixed-top sticky">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}"><img src="{{ asset('assets/images/favicon.ico') }}" alt="" height="30"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="mdi mdi-menu text-muted"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" id="navbar-navlist">
                        
                        <li class="nav-item d-flex align-items-center">
                            <a href="{{ route('login') }}" class="nav-link" style="cursor: pointer;"> <span><i class="mdi mdi-login" style="font-size: 14px;"></i></span> Login</a>
                        </li>
                    </ul>
                    <!--end navbar-nav-->
                </div>
                <!--end collapse-->
            </div>
            <!--end container-->
        </nav>
        <!-- END NAVBAR -->


        <!-- start-HOME -->
        <section class="bg-home6 overflow-hidden" id="home">
            <img src="{{ asset('assets/images/library_background.jpg') }}" alt="library" class="library-background">
            <div class="bg-overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center text-white">
                            <h6 class="home-subtitle mb-4">Internal Library System</h6>
                            <h1>Find your next read, right from your classroom</h1>
                            <p class="home-desc pt-3">Search thousands of books, check availability, track your borrowings, and stay updated with library announcements — built for students and staff.</p>
                            <div class="mt-4 pt-3">
                                <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!-- END HOME -->

        <div class="row justify-content-center mt-5">
            <div class="col-md-6 col-lg-3">
                <div class="text-center mt-3">
                    <h3>
                        <span>{{ $totalBooks }}</span>
                    </h3>
                    <p class="text-muted">Total Books</p>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-6 col-lg-3">
                <div class="text-center mt-3">
                    <h3>
                        <span>{{ $categories }}</span>
                    </h3>
                    <p class="text-muted">Book Categories</p>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-6 col-lg-3">
                <div class="text-center mt-3">
                    <h3>{{ $borrowed }}</h3>
                    <p class="text-muted">Borrowed</p>
                </div>
            </div>
            <!--end col-->

            <div class="col-md-6 col-lg-3">
                <div class="text-center mt-3">
                    <h3>{{ $activePatrons }}</h3>
                    <p class="text-muted">Active Patrons</p>
                </div>
            </div>
            <!--end col-->
        </div>


        <!-- START CATEGORIES -->
        <section class="section" id="features">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-5">
                            <h3>Library System Features</h3>
                            <p class="text-muted">Our library management system is designed to make borrowing, tracking, and managing books faster and more convenient.</p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box card border-0 mt-3">
                            <div class="card-body">
                                <div class="feature-icon mx-auto">
                                    <i class="mdi mdi-magnify"></i>
                                </div>
                                <div class="mt-4">
                                    <h6 class="mb-3 fs-17">Fast Book Search</h6>
                                    <p class="text-muted"> Quickly find books, authors, and categories using our smart and easy-to-use search system.</p>
                                </div>
                                <div class="feature-link">
                                    {{-- <a href="#" class="text-primary text-decoration-underline">Learn More <i
                                            class="mdi mdi-arrow-right"></i></a> --}}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end feature-box-->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box card border-0 mt-3">
                            <div class="card-body">
                                <div class="feature-icon mx-auto">
                                    <i class="mdi mdi-book-clock-outline"></i>
                                </div>
                                <div class="mt-4">
                                    <h6 class="mb-3 fs-17">Easy Borrow Tracking</h6>
                                    <p class="text-muted"> Monitor borrowed books, return dates, and borrower records with an organized tracking system.</p>
                                </div>
                                <div class="feature-link">
                                    {{-- <a href="#" class="text-primary text-decoration-underline">Learn More <i
                                            class="mdi mdi-arrow-right"></i></a> --}}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end feature-box-->
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-box card border-0 mt-3">
                            <div class="card-body">
                                <div class="feature-icon mx-auto">
                                    <i class="mdi mdi-shield-check-outline"></i>
                                </div>
                                <div class="mt-4">
                                    <h6 class="mb-3 fs-17">Secure Management</h6>
                                    <p class="text-muted"> Keep library records safe and organized with a secure and reliable management system.</p>
                                </div>
                                <div class="feature-link">
                                    {{-- <a href="#" class="text-primary text-decoration-underline">Learn More <i
                                            class="mdi mdi-arrow-right"></i></a> --}}
                                </div>
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end feature-box-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </section>
        <!-- END FEATURES -->

        {{-- START TABLES --}}
        <section class="section bg-light" id="tables">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-5">
                            <h3>Library Information</h3>
                            <p class="text-muted">This section displays all the information about the library.</p>
                        </div>
                    </div>
                    <!--end col-->
                </div>     
                <div class="row">
                    <div class="col-lg-6 col-md-12 p-2">
                        <div class="price-box card border-0 mt-4">
                            <div class="text-center">
                                <h5 class="mb-0">Library Hours</h5>
                            </div>
                            <div class="price-features mt-5">
                                @if ($libraryHours)
                                @foreach ($libraryHours as $item)
                                    @php
                                        // Check if the item's day matches the current system day name
                                        $isToday = strtolower($item->day) === strtolower(now()->format('l'));
                                    @endphp
                                    <p class="p-2 {{ $isToday ? 'bg-light text-primary' : ''}}"> {{$item->day}}
                                        <span class="fw-medium float-end">
                                            @if ($item->is_closed == 0)
                                                {{ \Carbon\Carbon::parse($item->open_time)->format('g:i A') }} - 
                                                {{ \Carbon\Carbon::parse($item->close_time)->format('g:i A') }}
                                            @else
                                            Closed
                                            @endif
                                        </span>
                                    </p>
                                @endforeach
                                @else
                                    <div class="container">
                                        <div class="d-flex justify-content-center align-items-center fw-bold fs-16">
                                            <div class="alert alert-info" role="alert">
                                                Library Hours to be updated.
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 p-2">
                        <div class="price-box card border-0 mt-4" style="overflow-y: scroll;">
                            <div class="text-center">
                                <h5 class="mb-0">Announcements</h5>
                            </div>
                            <div class="price-features mt-5">
                                @if ($announcements->count() > 0)
                                    @foreach ($announcements as $item)
                                        @php 
                                            $badge = 'bg-secondary';

                                            switch ($item->type) {
                                                case 'announcement':
                                                    $badge = 'bg-primary';
                                                    break;

                                                case 'reminder':
                                                    $badge = 'bg-warning';
                                                    break;

                                                case 'urgent':
                                                    $badge = 'bg-danger';
                                                    break;

                                                default:
                                                    $badge = 'bg-secondary';
                                                    break;
                                            }
                                        @endphp
                                        <div class="alert alert-secondary mt-2" role="alert">
                                            <div class="badge {{ $badge }} mb-2 text-uppercase">{{ $item->type }}</div>
                                            <p class="fw-bold">{{ $item->title }}</p>
                                            <p class="fw-normal text-truncate" style="max-width: 360px;"> {{ $item->body }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-secondary" role="alert">
                                        No Announcements
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- END TABLES --}}


        <!-- START FOOTER -->
        <footer class="bg-dark section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="text-secondary fs-16">Internal Library System - For Internal use only</p>
                        </div>
                        <div class="footer-terms">
                            <ul class="mb-0 list-inline text-center mt-4">
                                <li class="list-inline-item"><a href="#" class="footer-link">Terms & Condition</a></li>
                                <li class="list-inline-item"><a href="#" class="footer-link">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="#" class="footer-link">Contact Us</a></li>
                            </ul>
                        </div>
                        <!--end footer-terms-->
                        <div class="mt-4 pt-2 text-center">
                            <p class="text-white-50 mb-0">
                                Created by PapiChans
                            </p>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </footer>
        <!-- END FOOTER -->

        <!--start back-to-top-->
        <button onclick="topFunction()" id="back-to-top">
            <i class="mdi mdi-arrow-up"></i>
        </button>
        <!--end back-to-top-->
</body>
    <script src="{{ asset('assets/js/landsay/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/landsay/index.init.js')}}"></script>
    <script src="{{ asset('assets/js/landsay/app.js')}}"></script>
</html>