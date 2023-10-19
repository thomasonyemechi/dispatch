@extends('layouts.other')

@section('page_title')
    order-details-for-{{$order->customer->name}}
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Customer Profile </h5>
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

        <div class="bg-primary rounded-top-4 mt-5 pt-5   shadow text-center profile-content">
            <img src="{{ asset('assets/img/profile/profile-1.jpg') }}" alt=""
                 class="img-fluid rounded-pill shadow profile-lg personal-profile-img mb-3 p-1 bg-white">
            <div class="mb-3">
                <div>
                    <h5 class="fw-bold text-white mb-1"> {{$customer->name}} </h5>
                    <p class="text-white-50"><i
                            class="bx bx-calendar me-2"></i>Added {{ date('j M, Y H:i a', strtotime($customer->created_at)) }}
                        | by
                        {{ $customer->user->name }}
                    </p>
                </div>
                <div class="d-flex align-items-center justify-content-center gap-2">
                    <div class="bg-success text-white d-flex align-items-center rounded-pill p-1">
                        <div class="light-bg-success rounded-pill icon-sm">
                            <img src="img/shield.png" alt="" class="img-fluid">
                        </div>
                        <p class="small px-2 m-0">Actvie Customer</p>
                    </div>

                </div>
            </div>

            <div class="mb-auto bg-primary osahan-header-tab shadow">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item col" role="presentation">
                        <button class="nav-link active" id="summary-tab" data-bs-toggle="tab"
                                data-bs-target="#summary-tab-pane" type="button" role="tab"
                                aria-controls="summary-tab-pane" aria-selected="false" tabindex="-1"><i
                                class="bx bxs-list-ol"></i> ORDERS
                        </button>
                    </li>
                    <li class="nav-item col" role="presentation">
                        <button class="nav-link" id="calender-tab" data-bs-toggle="tab"
                                data-bs-target="#calender-tab-pane" type="button" role="tab"
                                aria-controls="calender-tab-pane" aria-selected="false" tabindex="-1"><i
                                class="bx bxs-paper-plane"></i> MESSAGE
                        </button>
                    </li>

                </ul>
            </div>
        </div>
        <div>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade active show" id="summary-tab-pane" role="tabpanel"
                     aria-labelledby="summary-tab"
                     tabindex="0">
                    <div class="p-3">


                        <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="text-center">
                                    <div class="bg-primary text-white rounded-pill icon-lg m-auto">
                                        <h5 class="text-white m-0">7+</h5>
                                    </div>
                                    <p class="pt-2 m-0 small">Orders</span></p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-success text-white rounded-pill icon-lg m-auto">
                                        <h5 class="text-white m-0">$</h5>
                                    </div>
                                    <p class="pt-2 m-0 small">$ 150,000</span>
                                    </p>
                                </div>
                                <div class="text-center">
                                    <div class="bg-info rounded-pill icon-lg m-auto">
                                        <h5 class="text-white m-0">8+</h5>
                                    </div>
                                    <p class="pt-2 m-0 small">Pre-School</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane fade" id="calender-tab-pane" role="tabpanel" aria-labelledby="calender-tab"
                     tabindex="0">

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
@endpush
