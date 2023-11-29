@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    orders
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Orders List </h5>
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








    <div class="vh-100 my-auto overflow-auto p-3">

        @if ($orders)
            <div class="bg-white rounded-3 shadow  p-3 border border mb-2">
                <form action="">
                    <input type="search" class="form-control " style="width: 100%" name="user"
                           placeholder="Search user">
                </form>
            </div>
        @endif

        <a href="/staff/create-order" class="btn mb-2 btn-outline-primary" style="width: 100%" > <i class="bx bx-plus" ></i> Create New Order </a>

        @foreach ($orders as $order)
            @php
                $statusInt = $order->status;
                $enumStatus = OrderStatus::fromInt($statusInt);
            @endphp
            <a href="/staff/customer/{{ $order->id }}" class="link-dark">
            <a href="/staff/order/{{ $order->id }}" class="link-dark">
                <div
                    class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                    <div>
                        <span class="small text-muted ">Services</span>

                        <ul class="fw-bold small mb-1 p-0" style="list-style: none">
                            @foreach (explode(',', $order->service_name) as $service)
                                <li>{{ $service }}</li>
                            @endforeach
                        </ul>

                        <div class="bg-light p-1 rounded">
                            <p class="mb-0 text-muted small">
                                Created By <span class="fw-bold" >{{ $order->staff->name }}</span> On
                                <span class="fw-bold" >{{ date('j M, Y', strtotime($order->created_at)) }}</span>
                            </p>
                        </div>

                        @if (!$order->designer)
                            <p class="text-danger mt-0 mb-0 small">No designer has started work on this order</p>
                        @endif


                        <div class="d-flex justify-content-start ">
                            <div class="badge bg-secondary me-2">Designer One</div>
                            @if ($order->designer)
                                <div class="badge bg-warning">Pending</div>
                            @endif
                        </div>





                    </div>

                </div>
            </a>
        @endforeach

        <div class="pt-3 d-flex justify-content-end ">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>


    </div>
@endsection


@push('scripts')
@endpush
