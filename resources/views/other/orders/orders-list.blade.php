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

        {{--        @dd($orders)--}}

        @foreach ($orders as $order)
            <a href="/staff/customer/{{ $order->id }}" class="link-dark">
                <div
                    class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                    <div>
                        <h6 class="mb-1"> {{ $order->customer->name }} </h6>
                        <p class="mb-1 text-muted small">Added {{ date('j M, Y H:i a', strtotime($order->created_at)) }}
                            |
                            by
                            {{ $order->staff->name }} </p>
                        {{--using the enum--}}
                        @if($order->status == OrderStatus::PENDING->statusCode())
                            <p class="fw-bold text-danger small m-0">{{OrderStatus::PENDING->value}}</p>
                        @elseif($order->status == OrderStatus::COMPLETED->statusCode())
                            <p class="fw-bold text-info small m-0">{{OrderStatus::COMPLETED->value}}</p>
                        @elseif($order->status == OrderStatus::DISPATCHED->statusCode())
                            <p class="fw-bold text-warning small m-0">{{OrderStatus::DISPATCHED->value}}</p>
                        @elseif($order->status == OrderStatus::DELIVERED->statusCode())
                            <p class="fw-bold text-success small m-0">{{OrderStatus::DELIVERED->value}}</p>
                        @elseif($order->status == OrderStatus::CANCELED->statusCode())
                            <p class="fw-bold text-danger small m-0">{{OrderStatus::CANCELED->value}}</p>
                        @endif
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
