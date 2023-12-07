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








    <div class="vh-100 my-auto overflow-auto p-3">
        @foreach ($orders as $order)
            @php
                $statusInt = $order->status;
                $enumStatus = OrderStatus::fromInt($statusInt);
            @endphp
            <a href="/staff/customer/{{ $order->id }}" class="link-dark">
                <a href="/staff/order/{{ $order->id }}" class="link-dark">
                    <div
                        class="bg-white rounded-3 shadow align-items-center justify-content-between p-3 border border mb-2">
                        <div>
                            <span class="small text-muted ">Services</span>

                            <ul class="fw-bold small mb-1 p-0" style="list-style: none">
                                @foreach (explode(',', $order->service_name) as $service)
                                    <li>{{ $service }}</li>
                                @endforeach
                            </ul>

                            <p class="mb-1 text-muted bg-light p-1 rounded d-inline small">
                                <span class="fw-bold">{{ date('j M, Y', strtotime($order->created_at)) }}</span>
                            </p>
                            @if (!$order->designer_id)
                                <p class="text-danger mt-0 mb-0 small">No designer has started work on this order
                                </p>
                            @endif

                            @php
                                $completed = completeDesign($order->id);
                            @endphp

                            @if ($completed)
                                <p class="text-success mt-0 mb-0 small">Order design has been completed by
                                    <span>{{ $order->designer->name }}
                                    </span>
                                </p>
                            @else
                                @if ($order->designer_id)
                                    <p class="text-info mt-0 mb-0 small">Design was slected by <span
                                            class="fw-bold">{{ $order->designer->name }}</span> </p>
                                @endif
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
