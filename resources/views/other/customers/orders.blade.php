@extends('layouts.other')

@section('page_title')
    Orders
@endsection
@section('page_content')

    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> My Orders </h5>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="/notification" class="bg-white shadow rounded-pill notification-icon position-relative">
                <i class="bx bxs-bell h5 m-0 text-primary"></i>
                <span
                    class="position-absolute top-0 ms-5 mt-1 translate-middle badge rounded-circle bg-danger py-1 fw-normal">
                    3
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>

        </div>
    </div>








    <div class="vh-100 my-auto overflow-auto p-3">

        {{-- @if ($current_orders || $past_orders)
            <div class="bg-white rounded-3 shadow  p-3 border border mb-2">
                <form action="">
                    <input type="search" class="form-control " style="width: 100%" name="orders"
                        placeholder="Search Orders">
                </form>
            </div>
        @endif --}}

        @if ($current_orders->count() > 0)
            <div class="mb-5">
                <h5 class="mb-3">Current</h5>
                <div>
                    @foreach ($current_orders as $order)
                        <a href="/staff/customer/{{ $order->id }}" class="link-dark">
                            <div
                                class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                                <div>
                                    <h6 class="mb-1"> {{ $order->service_name }} </h6>
                                    <p class="mb-1 text-muted small">
                                        Added {{ date('j M, Y H:i a', strtotime($order->created_at)) }}
                                    </p>
                                    @php
                                        $statusInt = $order->status;
                                        $enumStatus = \App\Enums\OrderStatus::fromInt($statusInt);
                                    @endphp
                                    <p class="{!! $enumStatus->statusClass() !!} mb-0">{{ $enumStatus }}<span
                                            class="fw-normal text-muted ms-1 small">{{ $order->time_left }} left</span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
        @if ($past_orders->count() > 0)
            <div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold m-0">Past</h5>
                    @if ($past_orders->count() > 6)
                        <a href="{{ route('customer.past-orders') }}" class="d-flex align-items-center gap-1">See All<i
                                class="bx bxs-chevron-right"></i></a>
                    @endif

                </div>
                @foreach ($past_orders as $order)
                    <a href="/staff/customer/{{ $order->id }}" class="link-dark">
                        <div
                            class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                            <div>
                                <h6 class="mb-1"> {{ $order->service_name }} </h6>
                                <p class="mb-1 text-muted small">
                                    Added {{ date('j M, Y H:i a', strtotime($order->created_at)) }}
                                </p>
                                @php
                                    $statusInt = $order->status;
                                    $enumStatus = \App\Enums\OrderStatus::fromInt($statusInt);
                                @endphp
                                <p class="{!! $enumStatus->statusClass() !!} mb-0">{{ $enumStatus }}<span
                                        class="fw-normal text-muted ms-1 small">{{ $order->time_left }} left</span>
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="mt-5 d-flex justify-content-center align-items-center">
                <div class="text-center" style="height: 16rem; width: 17rem;">
                    <img src="{{ asset('assets/img/errors/empty_cart.svg') }}" alt="empty" class="img-fluid">
                    <p class="text-center text-muted mt-3 font-900">Oops... No order has been created under this account</p>
                </div>
            </div>
        @endif


    </div>
@endsection


@push('scripts')
@endpush
