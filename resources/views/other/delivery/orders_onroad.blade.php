@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    Orders En Route
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> On the road </h5>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="#" class="bg-white shadow rounded-pill notification-icon position-relative">
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

        <div class="alert alert-secondary text-center">
            These are orders that are currently being transported
        </div>


        @foreach ($orders as $dispatch_id => $order_list)
            @php
                $dispatcher = user($dispatch_id);
            @endphp
            <div class="order-group bg-secondary rounded m-3 mb-4 p-3">

                <div class="border-bottom bg-white mb-3 p-3 rounded d-flex align-items-center ">
                    <img src="{{ asset($dispatcher->photo) }}" alt="" class="img-fluid me-2 rounded-lg profile">
                    <div>
                        <h6 class="mb-0"> {{ $dispatcher->name }} </h6>
                        <a href="#" class="text-warning m-0">Track Dispatcher Orders</a>
                    </div>
                </div>



                @foreach ($order_list as $order)
                    <div
                        class="bg-white rounded-3 shadow align-items-center justify-content-between p-3 border border mb-2">
                        <div>
                            <p class="mb-0 d-inline rounded text-muted small bg-light p-1 ">
                                <span class="fw-bold"># {{ $order->id }}</span>
                            </p>
                            <h6 class="small mt-1">{{ $order->service_name }}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach


    </div>
@endsection


@push('scripts')
@endpush
