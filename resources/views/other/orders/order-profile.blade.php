@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    order-details-for-{{ $order->customer->name }}
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
                <img src="{{ asset($order->customer->photo) }}" alt class="img-fluid shadow rounded-lg profile-img">
                <div class="mt-2 gap-2 d-flex justify-content-center">
                    <div class="light-bg-success rounded-pill text-center badge p-1">active</div>
                </div>
            </div>
            <div class="d-flex align-items-end gap-4">
                <div class="w-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6 class="fw-bold mb-0">{{ $order->customer->name }}</h6>
                    </div>
                    <p class="mb-1"><i class="bx bxs-phone text-muted me-1"></i>{{ $order->customer->phone }}</p>
                    <p class="mb-1"><i class="bx bxs-envelope text-muted me-1"></i>{{ $order->customer->email }}</p>
                    <p class="fw-bold mb-1"><i class="bx bxs-map-pin text-muted me-1"></i>{{ $order->customer->address }}
                    </p>
                </div>
            </div>
        </div>

        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Designer</h6>
            <div class="d-flex align-items-center justify-content-between">
                <h6 class="m-0 text-muted small">Assigned</h6>
                <h6 class="fw-bold text-primary m-0 small">{{ $order->designer->name }}</h6>
            </div>
        </div>

        @php
            $statusInt = $order->status;
            $enumStatus = OrderStatus::fromInt($statusInt);
        @endphp
        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Details</h6>
            <p class="mb-1 text-muted small">created by: {{ $order->staff->name }}</p>
            <p class="fw-bold {!! $enumStatus->statusClass() !!} small m-0">status: {{ $enumStatus }}</p>
            <p class="mb-1 text-muted small">service name: {{ $order->service_name }}</p>
            <p class="mb-1 text-muted small">total
                price: &#8358;{{ number_format($order->total_price, 2, '.', ',') }}</p>
            <p class="mb-1 text-muted small">advance
                paid: &#8358;{{ number_format($order->advance_paid, 2, '.', ',') }}</p>
            <p class="mb-1 text-muted small">no of files: {{ count(json_decode($order->files)) }}</p>
        </div>
        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Receiver's Information</h6>
            <p class="mb-1 text-muted small">Address: {{ $order->receiver_address }}</p>
            <p class="mb-1 text-muted small">Phone: {{ $order->receiver_phone }}</p>
            <p class="mb-1 text-muted small">Date: {{ date('j M, Y ', strtotime($order->receiving_date)) }}</p>
        </div>




        <div class="mb-2 bg-white shadow p-3 border">
            @if ($order->dispatcher)
                <div class="d-flex">
                    <img src="{{ asset('assets/img/profile/profile-2.jpg') }}" alt=""
                        class="img-fluid shadow me-2 rounded-pill profile-lg">
                    <div class="mt-2">
                        <h6 class="fw-bold"> {{ $order->dispatcher->name }} </h6>
                        <div class="badge bg-info">Dispatch Rider</div>
                        <a href="" class="d-block">Re-assign rider</a>
                    </div>
                </div>
            @endif

            <hr>

            @if ($order->designer)
                <div class="d-flex" style="height: 30px">
                    <img src="{{ asset($order->designer->photo) }}" alt=""
                        class="img-fluid shadow me-2 rounded-pill profile-lg">
                    <div class="mt-2">
                        <h6 class="fw-bold"> {{ $order->designer->name }} </h6>
                        <div class="badge bg-">Designer</div>
                        <a href="" class="d-block">Re-assign rider</a>
                    </div>
                </div>
            @endif
        </div>


        <div class="text-center px-3">
            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRightEditProfile"
                aria-controls="offcanvasRightEditProfile"
                class="btn btn-outline-primary bg-white shadow rounded-3 w-100 px-5 mb-3">Change
                Status</a>

            <a href="#" data-bs-toggle="offcanvas" data-bs-target="#assignRider" aria-controls="assignRider"
                class="btn btn-outline-warning bg-white shadow rounded-3 w-100 px-5 mb-3">Assign Dispatch Rider</a>
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
                action="{{ route('staff.update-order-status', ['id' => $order->id]) }}">
                @csrf
                <div class="mb-3">
                    <label for="order_status_edit" class="form-label text-muted small mb-0">Order Status</label>
                    <select class="form-select" id="order_status_edit" name="status">
                        <option value="{{ OrderStatus::PENDING->statusCode() }}"
                            @if ($order->status == OrderStatus::PENDING->statusCode()) selected @endif>{{ OrderStatus::PENDING->value }}
                        </option>
                        <option value="{{ OrderStatus::COMPLETED->statusCode() }}"
                            @if ($order->status == OrderStatus::COMPLETED->statusCode()) selected @endif>{{ OrderStatus::COMPLETED->value }}
                        </option>
                        <option value="{{ OrderStatus::DISPATCHED->statusCode() }}"
                            @if ($order->status == OrderStatus::DISPATCHED->statusCode()) selected @endif>{{ OrderStatus::DISPATCHED->value }}
                        </option>
                        <option value="{{ OrderStatus::DELIVERED->statusCode() }}"
                            @if ($order->status == OrderStatus::DELIVERED->statusCode()) selected @endif>{{ OrderStatus::DELIVERED->value }}
                        </option>
                        <option value="{{ OrderStatus::CANCELED->statusCode() }}"
                            @if ($order->status == OrderStatus::CANCELED->statusCode()) selected @endif>{{ OrderStatus::CANCELED->value }}
                        </option>
                        @foreach (OrderStatus::all() as $status)
                            <option value="{{ $status->statusCode() }}" @if ($order->status == $status->statusCode()) selected @endif>
                                {{ $status->value }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
    </div>




    {{-- this canvas assign a dispatch rider to a status --}}
    <div class="offcanvas offcanvas-end bg-lighter border-0 w-100" tabindex="-1" id="assignRider"
        aria-labelledby="assignRiderLabel">
        <div class="offcanvas-header border-bottom">
            <a href="#" class="link-dark d-flex" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="bx bx-arrow-back bx-sm"></i></a>
            <h6 class="offcanvas-title m-0" id="assignRiderLabel">Assgin a Dispatch Rider </h6>
            <span></span>
        </div>
        <div class="offcanvas-body">
            <form id="assign_rider" method="post" action="{{ route('staff.update-order-rider') }}">
                @csrf
                <div>
                    <div class="alert alert-warning">
                        Assigning a dispatch rider to this order mean that this order has been:
                        <ul>
                            <li>received and confirmed by customer</li>
                            <li>designed by the designer</li>
                            <li>Processed and package by the company staff</li>
                            <li>made ready for delivery</li>
                        </ul>
                    </div>

                    <div class="form-group mt-3">
                        <label for="">Receiver's Address:</label>
                        <input type="text" class="form-control" readonly value="{{ $order->receiver_address }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="">Receiver's Phone:</label>
                        <input type="text" class="form-control" readonly value="{{ $order->receiver_phone }}">
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                    </div>

                    <div class="form-group mt-3">
                        <label for="">Select Rider</label>
                        <select name="rider_id" class="form-control" id="" required>
                            @foreach ($dispatch_riders as $rider)
                                <option value="{{ $rider->id }}"> {{ $rider->name }} | {{ $rider->phone }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="d-flex">
                            <input type="checkbox" class="form-check me-3">
                            <span class="mt-1">Are you sure you want to assign a rider</span>
                        </label>
                    </div>

                    <div class="form-group mt-3">
                        <button class=" btn btn-block btn-outline-info " style="width: 100%">
                            Assign Dispatch Rider
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const link = document.querySelector('#edit-status-link');
        const form = document.querySelector('#edit-status-form');

        link.addEventListener('click', function(e) {
            e.preventDefault();
            form.submit();
        });


        $(function() {

            // $('#assignRider').canvas('show')

            // $('#assign_rider').on('submit', function(event) {
            //     event.preventDefault()
            //     this.submit();
            // })
        })
    </script>
@endpush
