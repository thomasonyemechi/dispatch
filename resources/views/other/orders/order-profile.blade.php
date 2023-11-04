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
                <img src="{{ asset($order->customer->photo) }}" alt class="img-fluid shadow rounded-lg profile-img"
                    style="object-fit: cover">
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

            <a href="javascript:;" class="showFilesModal fw-bold"> View Files</a>
        </div>
        <div class="mb-2 bg-white shadow p-3 border">
            <h6 class="fw-bold">Receiver's Information</h6>
            <p class="mb-1 text-muted small">Address: {{ $order->receiver_address }}</p>
            <p class="mb-1 text-muted small">Phone: {{ $order->receiver_phone }}</p>
            <p class="mb-1 text-muted small">Date: {{ date('j M, Y ', strtotime($order->receiving_date)) }}</p>
        </div>



        @if ($order->designer)
            <div class="mb-2 bg-white shadow p-3 border">
                <h6 class="fw-bold mb-1">Designer Info</h6>
                <p class="text-warning">Ensure order design is properly created by designer</p>
                <div class="d-flex justify-content-between ">
                    <div class="d-flex">
                        <img src="{{ asset($order->designer->photo) }}" alt=""
                            class="img-fluid shadow me-2 rounded-pill" style="width:55px; height: 55px; object-fit:cover;">
                        <div class="mt-1">
                            <h6 class="fw-bold mb-1 fs-5"> {{ $order->designer->name }} </h6>
                            <div class="badge bg-info">{{ $order->designer->role }}</div>
                            <div class="badge bg-secondary">{{ $order->designer->phone }}</div>
                        </div>
                    </div>
                    <div class="">
                        <div class="float-end mt-1">
                            <div class="badge  bg-warning">Pending</div>
                            <a href="javascript:;" class="d-block mt-2 "> <i class="bx bx-bell me-1"></i> <span>Alert</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="text-center px-3">
            <a href="#" class="btn btn-outline-warning bg-white shadow rounded-3 w-100 px-5 mb-3">Push To Delivery
                Department</a>
        </div>
    </div>

    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex mb-3 justify-content-between ">
                        <h5 class="modal-title" id="fileModal">Modal title</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="">
                        @foreach (json_decode($order->files) as $file)
                            <div class="mb-2">
                                <div class="d-flex justify-content-between rounded bg-light p-2">
                                    <span class="d-flex"><i class="bx me-1  {{ getExt($file) }} fs-4 fw-bold"> </i>
                                        <h6 class="mb-0 d-inline mt-1"> {{ $file }} </h6>
                                    </span> <span><a href="javascript:;"> <i class="bx bx-cloud-download fs-4 fw-bold"></i>
                                        </a></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
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

            fileModal = $('#fileModal')
            // fileModal.modal('show')
            $('.showFilesModal').on('click', function() {
                fileModal.modal('show')
            })
            fileModal.find('.btn-close').on('click', function() {
                fileModal.modal('hide');
            })

            // $('#assignRider').canvas('show')

            // $('#assign_rider').on('submit', function(event) {
            //     event.preventDefault()
            //     this.submit();
            // })
        })
    </script>
@endpush
