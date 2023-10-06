@extends('layouts.other')

@section('page_title')
    Dashboard
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <img src="{{ asset('assets/img/my-profile.jpg') }}" alt class="img-fluid rounded-pill profile">
        <div>
            <small class="mb-1 text-white-50"> {{ auth()->user()->phone }} </small>
            <h6 class="fw-bold text-white mb-0"> {{ auth()->user()->name }} </h6>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="notification.html" class="bg-white shadow rounded-pill notification-icon position-relative">
                <i class="bx bxs-bell h5 m-0 text-primary"></i>
                <span
                    class="position-absolute top-0 ms-5 mt-1 translate-middle badge rounded-circle bg-danger py-1 fw-normal">
                    3
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
            <a class="toggle notification-icon d-flex align-items-center bg-white rounded-pill" href="#"><i
                    class="bx bx-menu bx-sm text-primary"></i></a>
        </div>
    </div>





    {{-- <div class="vh-100 my-auto overflow-auto">

        <div class="pb-3 pt-3 bg-white shadow border-bottom">
            <div class="d-flex align-items-center justify-content-between px-3 pb-3 pt-1">
                <h6 class="fw-bold m-0">Recently Added</h6>
                <a href="my-favorites.html" class="d-flex align-items-center gap-1">See All<i
                        class="bx bxs-chevron-right"></i></a>
            </div>

            <div class="favorites-slider">
                <div class="favorites-item text-center">
                    <img src="{{ asset('assets/img/profile/profile-1.jpg') }}" alt class="img-fluid shadow rounded-pill profile-lg">
                    <p class="pt-2 m-0 lh-1">Victoria</p>
                    <small class="text-success small">Online</small>
                </div>
                <div class="favorites-item text-center">
                    <img src="{{ asset('assets/img/profile/profile-2.jpg') }}" alt class="img-fluid shadow rounded-pill profile-lg">
                    <p class="pt-2 m-0 lh-1">David</p>
                    <small class="text-danger small">Offline</small>
                </div>
                <div class="favorites-item text-center">
                    <img src="{{ asset('assets/img/profile/profile-3.jpg') }}" alt class="img-fluid shadow rounded-pill profile-lg">
                    <p class="pt-2 m-0 lh-1">Harvey</p>
                    <small class="text-success small">Online</small>
                </div>
                <div class="favorites-item text-center">
                    <img src="{{ asset('assets/img/profile/profile-4.jpg') }}" alt class="img-fluid shadow rounded-pill profile-lg">
                    <p class="pt-2 m-0 lh-1">Sophia</p>
                    <small class="text-success small">Online</small>
                </div>
                <div class="favorites-item text-center">
                    <img src="{{ asset('assets/img/profile/profile-5.jpg') }}" alt class="img-fluid shadow rounded-pill profile-lg">
                    <p class="pt-2 m-0 lh-1">James</p>
                    <small class="text-danger small">Offline</small>
                </div>
            </div>
        </div>

        <div class="p-3">
            <div class="create-job-background shadow-sm rounded-3 p-4 mb-4 d-flex">
                <div class="text-white">
                    <h6 class="fw-bold lh-base mb-3">Find the right trusted<br> caregiver for your family</h6>
                    <a href="#" class="btn btn-warning">Create a Job post</a>
                </div>
                <img src="../../../static.wixstatic.com/media/6158ef_a699758dd65d472493287c0fe035bc9e_mv2.png/v1/crop/x_97%2cy_34%2cw_607%2ch_737/fill/w_322%2ch_392%2cal_c%2cq_85%2cusm_0.66_1.00_0.01%2cenc_auto/Helpee%20Caregivers.png"
                    alt class="img-fluid ms-auto profile-lg">
            </div>

            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold m-0">Next Plan</h6>
                    <a href="interview-in-past.html" class="d-flex align-items-center gap-1">See All <i
                            class="bx bxs-chevron-right"></i></a>
                </div>
                <div>
                    <a data-bs-toggle="modal" data-bs-target="#interviewModal" href="#" class="link-dark">
                        <div
                            class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                            <div>
                                <h6 class="mb-1">Christine Brandley</h6>
                                <p class="mb-1 small text-muted">Today . 17:00 - 17:30</p>
                                <p class="text-warning mb-0">Unconfirmed<span class="fw-normal text-muted ms-1 small">19
                                        hours left</span></p>
                            </div>
                            <img src="img/profile/profile-1.jpg" alt class="img-fluid rounded-pill profile">
                        </div>
                    </a>
                    <a data-bs-toggle="modal" data-bs-target="#interviewModal" href="#" class="link-dark">
                        <div class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border">
                            <div>
                                <h6 class="mb-1">Lela Ramos</h6>
                                <p class="mb-1 small text-muted">Thu SEP 2 . 14:00 - 14:30</p>
                                <p class="text-primary m-0">Accepted</p>
                            </div>
                            <img src="img/profile/profile-4.jpg" alt class="img-fluid rounded-pill profile">
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="px-3 pb-3">

            <div class="overflow-hidden upgrade-background shadow-sm rounded-3 mb-4 d-flex align-items-center">
                <div class="col-7 py-4 ps-4">
                    <h6 class="fw-bold lh-base mb-2">Find the right trusted<br>caregiver for your<br> family</h6>
                    <a href="#" class="fw-bold bg-danger shadow text-white small px-2 py-1 rounded-pill">Upgrade
                        Now</a>
                </div>
                <img src="../../../circleof.com/static/a4dd1b282737d8f603093c5d1b6ee3cd/7ffe1/hero.png" alt
                    class="img-fluid col-5 ms-auto pt-2 mt-auto">
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6 class="fw-bold m-0">Recommended for you</h6>
                <a href="#" class="d-flex align-items-center gap-1">See All<i class="bx bxs-chevron-right"></i></a>
            </div>

            <a href="profile.html" class="link-dark">
                <div class="bg-white shadow rounded-3 p-3 mb-2 profile-detail border osahan-card">
                    <div class="osahan-card-left">
                        <img src="img/profile/profile-1.jpg" alt class="img-fluid shadow rounded-lg profile-img">
                        <div class="mt-2 gap-2 d-flex">
                            <span class="light-bg-success rounded-lg icon-sm"><img src="img/shield.png" alt
                                    class="img-fluid"></span>
                            <span class="bg-primary rounded-lg icon-sm"><img src="img/diamond.png" alt
                                    class="img-fluid"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-4">
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold mb-0">Edith Johnson</h6>
                                <i class="bx bxs-heart text-danger"></i>
                            </div>
                            <p class="mb-1"><i class="bx bx-female-sign text-muted me-1"></i>28 . 6 yrs paid
                                experience
                            </p>
                            <p class="mb-1"><i class="bx bxs-home-heart text-muted me-1"></i>Boston, NY . 2
                                miles
                            </p>
                            <p class="fw-bold mb-1"><i class="bx bxs-star text-warning me-1"></i>4.85 <span
                                    class="text-muted fw-normal small">(215 reviews)</span></p>
                            <p class="fw-bold m-0"><i class="bx bxs-dollar-circle text-muted me-1"></i>$15-$20/hr
                                <span class="text-muted fw-normal small">Cared for 192 families</span>
                            </p>
                        </div>
                    </div>
                </div>
            </a>

            <a href="profile.html" class="link-dark">
                <div class="bg-white shadow rounded-3 p-3 profile-detail border osahan-card">
                    <div class="osahan-card-left">
                        <img src="img/profile/profile-2.jpg" alt class="img-fluid shadow rounded-lg profile-img">
                        <div class="mt-2 gap-2 d-flex">
                            <span class="light-bg-success rounded-lg icon-sm"><img src="img/shield.png" alt
                                    class="img-fluid"></span>
                            <span class="bg-primary rounded-lg icon-sm"><img src="img/diamond.png" alt
                                    class="img-fluid"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-end gap-4">
                        <div class="w-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h6 class="fw-bold mb-0">Christan McLaughlin</h6>
                                <i class="bx bx-heart text-muted"></i>
                            </div>
                            <p class="mb-1"><i class="bx bx-male-sign text-muted me-1"></i>28 . 6 yrs paid
                                experience
                            </p>
                            <p class="mb-1"><i class="bx bxs-home-heart text-muted me-1"></i>Rochester, NY . 2
                                miles
                            </p>
                            <p class="fw-bold mb-1"><i class="bx bxs-star text-warning me-1"></i>4.85 <span
                                    class="text-muted fw-normal small">(215 reviews)</span></p>
                            <p class="fw-bold m-0"><i class="bx bxs-dollar-circle text-muted me-1"></i>$10-$15/hr
                                <span class="text-muted fw-normal small">Cared for 192 families</span>
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div> --}}
@endsection


@push('scripts')
@endpush
