@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    Ready For Dispatch
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Ready For Dispatch </h5>
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

        <div class="alert alert-secondary">
            Orders ready to be assigned to rider for transport
        </div>

        @foreach ($orders as $order)
            <div class="bg-white rounded-3 shadow align-items-center justify-content-between p-3 border border mb-2">
                <div>
                    <div class="form-">
                        <input type="checkbox" class="form-check-input order me-2" id="order_{{ $order->id }}"
                            value="{{ $order->id }}">
                        <label class="form-check-label  fw-bold d-inline "
                            for="order_{{ $order->id }}">{{ $order->service_name }}</label>
                    </div>


                    <p class="mb-1 text-muted rounded d-inline small">
                        <span class="fw-bold"> Created by {{ $order->staff->name }} </span>
                        {{ date('j M, Y', strtotime($order->created_at)) }}
                    </p>

                    <div>
                        <h6 class="fw-bold mb-0 mt-2 small">Receiver's Information</h6>
                        <p class="mb-1 text-muted small">Address: {{ $order->receiver_address }}</p>
                        <p class="mb-1 text-muted small">Phone: {{ $order->receiver_phone }}</p>
                        <p class="mb-1 text-muted small">Date: {{ date('j M, Y ', strtotime($order->receiving_date)) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach


        <div>
            <div>
                <button class="btn btn-outline-info bg-white shadow rounded-3 assgin_to_rider w-100 px-5 mb-3">Assign To
                    Dispatch Rider
                </button>
            </div>
        </div>

        <div class="pt-3 d-flex justify-content-end ">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </div>



    <div class="modal fade" id="assignRiderModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="d-flex mb-3 justify-content-between ">
                        <h5 class="modal-title">Select Dispatch Rider</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="">
                        <div class="alert alert-info">
                            Select the dispatcher that will be transporting this order
                        </div>

                        <div class="alert alert-warning">
                            Rider will be alerted and will be able to see roder and change transport status
                        </div>
                        <form action="/delivery/assgin_rider" method="post" > @csrf
                            <div class="mb-3 form-group ">
                                <label class="form-label text-muted mb-1 small">Select Rider</label>
                                <select name="rider_id" class="form-control">
                                    @foreach ($riders as $rider)
                                        <option value="{{ $rider->id }}"> {{ $rider->name }} </option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="orders">
                            </div>

                            <div class="d-flex  justify-content-end ">
                                <button class="btn btn-primary">Assign Rider</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {


            $('.assgin_to_rider').on('click', function() {

                let orders = $('.order');
                arr = []
                for (i = 0; i < orders.length; i++) {
                    ord = orders[i];
                    val = ord.value;
                    if (ord.checked) {
                        arr.push(val);
                    }
                }

                modal = $('#assignRiderModal')
                modal.modal('show')
                modal.find('input[name="orders"]').val(arr);
            })
        })
    </script>
@endpush
