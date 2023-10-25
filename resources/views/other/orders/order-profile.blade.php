@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    order-details-for-{{$order->customer->name}}
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Order Details </h5>
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

        <div class="bg-white shadow p-3 mb-2 profile-detail border osahan-card">
            <div class="osahan-card-left">
                <img src="{{asset($order->customer->photo)}}" alt class="img-fluid shadow rounded-lg profile-img">
                <div class="mt-2 gap-2 d-flex justify-content-center">
                    <div class="light-bg-success rounded-pill text-center badge p-1">active</div>
                </div>
            </div>
            <div class="d-flex align-items-end gap-4">
                <div class="w-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold mb-0">{{$order->customer->name}}</h6>
                    </div>
                    <p class="mb-1"><i class="bx bxs-phone text-muted me-1"></i>{{$order->customer->phone}}</p>
                    <p class="mb-1"><i class="bx bxs-envelope text-muted me-1"></i>{{$order->customer->email}}</p>
                    <p class="fw-bold mb-1"><i class="bx bxs-map-pin text-muted me-1"></i>{{$order->customer->address}}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Designer</h6>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="m-0 text-muted small">Assigned</h6>
                <h6 class="fw-bold text-primary m-0 small">{{$order->designer->name}}</h6>
            </div>
        </div>

        @php
            $statusInt = $order->status;
            $enumStatus = OrderStatus::fromInt($statusInt);
        @endphp
        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Details</h6>
            <p class="mb-1 text-muted small">created by: {{$order->staff->name}}</p>
            <p class="fw-bold {!! $enumStatus->statusClass() !!} small m-0">status: {{$enumStatus}}</p>
            <p class="mb-1 text-muted small">service name: {{$order->service_name}}</p>
            <p class="mb-1 text-muted small">total
                price: &#8358;{{number_format($order->total_price, 2, '.', ',')}}</p>
            <p class="mb-1 text-muted small">advance
                paid: &#8358;{{number_format($order->advance_paid, 2, '.', ',')}}</p>
            <p class="mb-1 text-muted small">no of files: {{count(json_decode($order->files))}}</p>
        </div>
        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Receive Information</h6>
            <p class="mb-1 text-muted small">receiver's address: {{$order->receiver_address}}</p>
            <p class="mb-1 text-muted small">receiver's phone: {{$order->receiver_phone}}</p>
            <p class="mb-1 text-muted small">receiving
                date: {{ date('j M, Y ', strtotime($order->receiving_date)) }}</p>
        </div>
        <div class="text-center px-3">
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightEditProfile"
               aria-controls="offcanvasRightEditProfile"
               class="btn btn-outline-primary bg-white shadow rounded-3 w-100 px-5 mb-3">Change
                Status</a>
        </div>
    </div>
    {{-- the edit off canvas for changing status --}}
    <div class="offcanvas offcanvas-end bg-lighter border-0 w-100" tabindex="-1" id="offcanvasRightEditProfile"
         aria-labelledby="offcanvasRightEditProfileLabel">
        <div class="offcanvas-header border-bottom">
            <a href="#" class="link-dark d-flex" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="bx bx-arrow-back bx-sm"></i></a>
            <h6 class="offcanvas-title m-0" id="offcanvasRightEditProfileLabel">Edit Status</h6>
            <a href="#" id="edit-status-link" data-bs-dismiss="offcanvas" aria-label="Close">Save</a>
        </div>
        <div class="offcanvas-body">
            <form id="edit-status-form" method="post"
                  action="{{ route('staff.update-order-status',['id'=>$order->id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="order_status_edit" class="form-label text-muted small mb-0">Order Status</label>
                    <select class="form-select" id="order_status_edit" name="status">
                        @foreach(OrderStatus::all() as $status)
                            <option value="{{ $status->statusCode() }}"
                                    @if($order->status == $status->statusCode()) selected @endif>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const link = document.querySelector('#edit-status-link');
        const form = document.querySelector('#edit-status-form');

        link.addEventListener('click', function (e) {
            e.preventDefault();
            form.submit();
        });
    </script>
@endpush
