@extends('layouts.other')

@section('page_title')
    Orders
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Order #{{ $order->id }} </h5>
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

        <div class="mb-5">
 

            <div class="text-center">
                <div>
                    <label class=" btn btn-outline-primary osahan-box" style="" >
                        <span class="fs-1 d-block fw-bold">{{ $order->time_left }}</span>
                    </label>
                </div>
                <span class="text-muted fw-bold mt-3">Left to delivery</span>

            </div>


            <div class="mb-2 bg-white mt-3 shadow p-3 text-center border">
                <h6 class="fw-bold fs-3 ">{{ $order->service_name }}</h6>
                <p class="mb-1 text-muted small">total
                    price: &#8358;{{ number_format($order->total_price, 2, '.', ',') }}</p>
                <p class="mb-1 text-muted small">advance
                    paid: &#8358;{{ number_format($order->advance_paid, 2, '.', ',') }}</p>
            </div>

            <div class="mb-2 bg-white shadow p-3 text-center border">
                <h6 class="fw-bold">Delivery Information</h6>
                <p class="mb-1 text-muted small">Address: {{ $order->receiver_address }}</p>
                <p class="mb-1 text-muted small">Phone: {{ $order->receiver_phone }}</p>
                <p class="mb-1 text-muted small">Date: {{ date('j M, Y ', strtotime($order->receiving_date)) }}</p>
            </div>





        </div>

    </div>
@endsection


@push('scripts')
@endpush
