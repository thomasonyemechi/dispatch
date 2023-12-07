@extends('layouts.other')

@section('page_title')
    Dashboard
@endsection
@section('page_content')
    <link rel="stylesheet" href="{{ asset('custom-style.css') }}">

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





    <div class="vh-100 my-auto overflow-auto">

        <div class="pb-3 pt-3 bg-white shadow border-bottom">
            <div class="d-flex align-items-center justify-content-between px-3 pb-3 pt-1">
                <h6 class="fw-bold m-0">See all Orders</h6>
                <a href="#" class="d-flex align-items-center gap-1">See All<i class="bx bxs-chevron-right"></i></a>
            </div>
        </div>


{{-- 
        <div class="p-3">
            <div class="row ">
                <div class="col-xl-6 col-lg-6 col-6">
                    <div class="card l-bg-cherry">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">New Orders</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        3,243
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-6">
                    <div class="card l-bg-blue-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Customers</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        15.07k
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-6">
                    <div class="card l-bg-green-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Ticket Resolved</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        578
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>10% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25"
                                    aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-6">
                    <div class="card l-bg-orange-dark">
                        <div class="card-statistic-3 p-4">
                            <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                            <div class="mb-4">
                                <h5 class="card-title mb-0">Revenue Today</h5>
                            </div>
                            <div class="row align-items-center mb-2 d-flex">
                                <div class="col-8">
                                    <h2 class="d-flex align-items-center mb-0">
                                        $11.61k
                                    </h2>
                                </div>
                                <div class="col-4 text-right">
                                    <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                </div>
                            </div>
                            <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="p-3">

            <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="text-center">
                        <a href="#">
                            <div class="bg-primary text-white rounded-pill icon-sm m-auto">
                                <h5 class="text-white m-0"><i class="bx bxs-user-plus"></i> </h5>
                            </div>
                            <p class="pt-2 m-0 small"> All Client</span></p>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="bg-success text-white rounded-pill icon-sm m-auto">
                                <h5 class="text-white m-0"> <i class="bx bx-plus"></i> </h5>
                            </div>
                            <p class="pt-2 m-0 small">transactions</span>
                            </p>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="bg-info rounded-pill icon-sm m-auto">
                                <h5 class="text-white m-0"> <i class="bx bx-list-ol"></i> </h5>
                            </div>
                            <p class="pt-2 m-0 small">Track Order</p>
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="#">
                            <div class="bg-success text-white rounded-pill icon-sm m-auto">
                                <h5 class="text-white m-0"> <i class="bx bx-plus"></i> </h5>
                            </div>
                            <p class="pt-2 m-0 small">New Order</span>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="p-3">
            <h6 class="fw-bold">Quick Actions</h6>
            <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                <div class="container-fluid">
                    <ul class="nav d-flex justify-content-between " id="iconbar">
                        <li><a class="text-center color-1" href="#"><i class="bx bx-tag fa-5x"></i> <br>Tags</a>
                        </li>
                        <li><a class="text-center color-2" href="#"><i class="bx bx-bookmark fa-5x"></i>
                                <br>Tasks</a>
                        </li>
                        <li><a class="text-center color-3" href="#"><i class="bx bx-camera fa-5x"></i>
                                <br>Photos</a>
                        </li>
                        <li><a class="text-center color-5" href="#"><i class="bx bx-music fa-5x"></i> <br>Tunes</a>
                        </li>
                        <li><a class="text-center color-6" href="#"><i class="bx bx-book fa-5x"></i> <br>Books</a>
                        </li>
                        <li><a class="text-center color-7" href="#"><i class="fa fa-film fa-5x"></i> <br>Videos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div> --}}


    </div>
@endsection


@push('scripts')
@endpush
