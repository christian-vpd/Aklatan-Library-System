@extends('master.admin_master')
@section('admin')
<div class="row g-2 align-items-center">
    <div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">Welcome Back!</div>
    <h2 class="page-title">{{Auth::user()->name}}</h2>
    </div>
    <div class="col-auto ms-auto d-print-none">
        <button class="btn text-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clock-hour-5">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
            <path d="M12 12l2 3" />
            <path d="M12 7v5" />
        </svg>
        <span id="clock">
            {{ \Carbon\Carbon::now('Asia/Manila')->format('F j, Y - g:i:s A') }}
        </span>
        </button>
    </div>
    <div class="col-12">
        <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/currency-dollar -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-books">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 5a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1l0 -14" />
                                <path d="M9 5a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1l0 -14" />
                                <path d="M5 8h4" />
                                <path d="M9 16h4" />
                                <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041" />
                                <path d="M14 9l4 -1" />
                                <path d="M16 16l3.923 -.98" />
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">{{ $totalBook }}</div>
                    <div class="text-secondary">Total Books</div>
                    </div> 
                </div>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/shopping-cart -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-hexagon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 13a3 3 0 1 0 0 -6a3 3 0 0 0 0 6" />
                            <path d="M6.201 18.744a4 4 0 0 1 3.799 -2.744h4a4 4 0 0 1 3.798 2.741" />
                            <path d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033" />
                        </svg>
                    </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">{{ $activeLibrarians }}</div>
                    <div class="text-secondary">Active Librarians</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">{{ $activePatrons }}</div>
                    <div class="text-secondary">Active Patrons</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
            <div class="col-sm-6 col-lg-3">
            <div class="card card-sm">
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-book">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                            <path d="M3 6l0 13" />
                            <path d="M12 6l0 13" />
                            <path d="M21 6l0 13" />
                        </svg>
                    </span>
                    </div>
                    <div class="col">
                    <div class="font-weight-medium">{{ $borrowed }}</div>
                    <div class="text-secondary">Borrowed Books</div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-2 mt-2">
    <div class="col-12 col-lg-6">
        <div class="card">
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
    <div class="col-12 col-lg-6">
        <div class="card">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead>
                    <tr>
                        <th>Policy Categories</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($policies as $item)
                        <tr>
                            <td class="fw-bold">{{$item->name}}</td>
                            <td class="fw-normal">{{$item->description}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    setInterval(function() {
        const clockElement = document.getElementById('clock');
        const now = new Date();
        
        const options = {
            timeZone: 'Asia/Manila',
            month: 'long',
            day: 'numeric',
            year: 'numeric',
            hour: 'numeric',
            minute: '2-digit',
            second: '2-digit',
            hour12: true,
        };

        const formatter = new Intl.DateTimeFormat('en-US', options);
            const parts = formatter.formatToParts(now);
            
            const hash = {};
            parts.forEach(p => hash[p.type] = p.value);

            const formattedTime = `${hash.month} ${hash.day}, ${hash.year} - ${hash.hour}:${hash.minute}:${hash.second} ${hash.dayPeriod}`;

            clockElement.textContent = formattedTime;
        }, 1000);
</script>
@endsection