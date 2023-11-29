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


        @foreach ($orders as $order)
            @php
                $statusInt = $order->status;
                $enumStatus = OrderStatus::fromInt($statusInt);
            @endphp
            <a href="/staff/customer/{{ $order->id }}" class="link-dark">
                {{--            <a href="/staff/order/{{ $order->id }}" class="link-dark">--}}
                <div
                    class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                    <div>
                        <h6 class="mb-1"> {{ $order->customer->name }} </h6>
                        <p class="mb-1 text-muted small">Added {{ date('j M, Y H:i a', strtotime($order->created_at)) }}
                            |
                            by
                            {{ $order->staff->name }} </p>
                        {{--using the enum--}}

                        <p class="fw-bold {!! $enumStatus->statusClass() !!} small m-0">{{ $enumStatus }}</p>
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
