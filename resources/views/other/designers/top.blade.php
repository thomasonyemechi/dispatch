<link rel="stylesheet" href="{{ asset('custom-style.css') }}">

<div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
    <img src="{{ asset('assets/img/my-profile.jpg') }}" alt class="img-fluid rounded-pill profile">
    <div>
        <small class="mb-1 text-white-50"> {{ auth()->user()->phone }} </small>
        <h6 class="fw-bold text-white mb-0"> {{ auth()->user()->name }} </h6>
    </div>

    <div class="d-flex align-items-center gap-3 ms-auto">
        <a class="toggle notification-icon d-flex align-items-center bg-white rounded-pill" href="#"><i
                class="bx bx-menu bx-sm text-primary"></i></a>
    </div>
</div>

