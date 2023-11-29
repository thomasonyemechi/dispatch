@extends('layouts.other')

@section('page_title')
    Dashboard
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Dashboard </h5>
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

        <div class="row row-cols-3 p-3 g-4 custom-check">
            <div class="col">
                <div class="text-center">
                    <div>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
                            checked="">
                        <label class="btn btn-outline-primary osahan-box" for="btnradio1"><i class="fs-1">200</i>
                        </label>
                    </div>
                    <p class="pt-2 m-0">New Orders<br><span class="text-muted small">Registered Today</span></p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <div>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-primary osahan-box" for="btnradio2"><i class="fs-1">6</i>
                        </label>
                    </div>
                    <p class="pt-2 m-0">Orders<br><span class="text-muted small">On the road</span></p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <div>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                        <label class="btn btn-outline-primary osahan-box" for="btnradio3"><i
                                class="fs-1">40</i>
                        </label>
                    </div>
                    <p class="pt-2 m-0">Urgent <br><span class="text-muted small">Delivery</span></p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <div>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                        <label class="btn btn-outline-primary osahan-box" for="btnradio4"><i
                                class="fs-1">750</i>
                        </label>
                    </div>
                    <p class="pt-2 m-0">Delivered<br><span class="text-muted small">Orders</span></p>
                </div>
            </div>
            <div class="col">
                <div class="text-center">
                    <div>
                        <input type="radio" class="btn-check" name="btnradio" id="btnradio5" autocomplete="off">
                        <label class="btn btn-outline-primary osahan-box" for="btnradio5"><i
                                class="fs-1">59</i>
                        </label>
                    </div>
                    <p class="pt-2 m-0">Ready<br><span class="text-muted small">For Dispatch</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection
