@extends('master.librarian_master')
@section('librarian')
<div class="container-xl">
    <div class="row g-2 align-items-center mb-4">
        <div class="col">
        <!-- Page pre-title -->
        <div class="page-pretitle">Librarian</div>
            <h2 class="page-title" id="greetings"></h2>
        </div>
    </div>
</div>
<div class="row row-cards">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <p class="subheader d-flex align-items-center text-primary">
                    <span class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-bar-right">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M20 12l-10 0" />
                            <path d="M20 12l-4 4" />
                            <path d="M20 12l-4 -4" />
                            <path d="M4 4l0 16" />
                        </svg>
                    </span>
                    Active Borrows
                </p>
                <h2 class="fw-bold">
                    {{ $borrow }}
                </h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <p class="subheader d-flex align-items-center text-primary">
                    <span class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-alert-triangle">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 9v4" />
                            <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0" />
                            <path d="M12 16h.01" />
                        </svg>
                    </span>
                    Overdue
                </p>
                <h2 class="fw-bold">
                    {{ $overdue }}
                </h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <p class="subheader d-flex align-items-center text-primary">
                    <span class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bookmark">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 7v14l-6 -4l-6 4v-14a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4" />
                        </svg>
                    </span>
                    Reservations
                </p>
                <h2 class="fw-bold">
                    {{ $reservation }}
                </h2>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="card">
            <div class="card-body">
                <p class="subheader d-flex align-items-center text-primary">
                    <span class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-coin">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                            <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                            <path d="M12 7v10" />
                        </svg>
                    </span>
                    Unpaid Fines
                </p>
                <h2 class="fw-bold">
                    ₱ {{ $fine, 2 }}
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-12 col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="h3" id="greetings">Today's Library Hours</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Days</th>
                                <th>Library Hours</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($libraryHours as $item)
                            @php
                                // Check if the item's day matches the current system day name
                                $isToday = strtolower($item->day) === strtolower(now()->format('l'));
                            @endphp
                            <tr class="{{ $isToday ? 'bg-light text-primary' : ''}}">
                                <td class="fw-bold">{{$item->day}}</td>
                                @if ($item->is_closed == 0)
                                <td class="{{ $isToday ? 'text-primary' : 'text-secondary'}}">
                                        {{ \Carbon\Carbon::parse($item->open_time)->format('g:i A') }} - 
                                        {{ \Carbon\Carbon::parse($item->close_time)->format('g:i A') }}
                                </td>
                                @else
                                    <td class="text-danger">Closed</td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <div class="card">
            <div class="card-header">
                <h3 class="h3">Recent Fines</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Patron</th>
                                <th>Fines</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($recentFines->count() > 0)
                                @foreach ($recentFines as $item)    
                                    <tr>
                                        <td>{{ $item->patron->first_name . $item->patron->last_name }}</td>
                                        <td>{{ $item->amount }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No Fines</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
<script>
    $(document).ready(function() {
        const hour = new Date().getHours();
    
        if (hour < 12) {
            $('#greetings').html('Good Morning!');
        } else if (hour < 18) {
            $('#greetings').html('Good Afternoon!');
        } else {
            $('#greetings').html('Good Evening!');
        }
    });
</script>
@endsection