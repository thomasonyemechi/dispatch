@extends('layouts.other')

@section('page_title')
    Dashboard
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Create Order </h5>
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


    <div class="booking-step-2 d-flex flex-column vh-100">
        <form action="/staff/create-order" method="POST" id="order-form" enctype="multipart/form-data">
            @csrf
            <div class="vh-100 my-auto overflow-auto p-3">

                <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                    <h6 class="">Customer Details</h6>


                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Customer's Phone Number <span
                                class="text-danger">*</span> </label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-phone bx-sm"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 rounded-0"
                                placeholder=" 09000000000" name="phone" value="{{ old('phone') }}"
                                aria-describedby="basic-addon1">

                        </div>

                        @error('phone')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror
                        <i class="phone_error"></i>
                    </div>
                </div>


                <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                    <h6 class="">Product Info</h6>

                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Service Name <span
                                class="text-danger">*</span></label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-note bx-sm"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 rounded-0"
                                placeholder="Explain what this customer wants" name="service_name"
                                value="{{ old('service_name') }}" aria-describedby="basic-addon1">

                        </div>

                        @error('service_name')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Upload Files <span
                                class="text-danger">*</span></label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-file bx-sm"></i></span>
                            <input type="file" class="form-control bg-transparent border-0 rounded-0" placeholder=""
                                name="files[]" aria-describedby="basic-addon1" multiple>

                        </div>

                        @error('files')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror
                    </div>

                    <div class="mb-3 row ">
                        <div class="col-6">
                            <label class="form-label text-muted mb-1 small">Total Price <span class="text-danger">*</span>
                            </label>
                            <div class="input-group border-bottom">
                                <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                    id="basic-addon1"><i class="bx bxs-diamond bx-sm"></i></span>
                                <input type="number" class="form-control bg-transparent border-0 rounded-0"
                                    placeholder="09000000000" name="total_price" value="{{ old('total_price') }}"
                                    aria-describedby="basic-addon1">
                            </div>
                            @error('total_price')
                                <i class="text-danger ">{{ $message }} </i>
                            @enderror
                        </div>


                        <div class="col-6">
                            <label class="form-label text-muted mb-1 small">Advance Paid <span class="text-danger">*</span>
                            </label>
                            <div class="input-group border-bottom">
                                <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                    id="basic-addon1"><i class="bx bxs-diamond bx-sm"></i></span>
                                <input type="text" class="form-control bg-transparent border-0 rounded-0"
                                    placeholder="09000000000" name="advance_paid" value="{{ old('advance_paid') }}"
                                    aria-describedby="basic-addon1">
                            </div>
                            @error('advance_paid')
                                <i class="text-danger ">{{ $message }} </i>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="mb-3 rounded-3 bg-white shadow p-3 border">
                    <h6 class="">Delivery Details</h6>

                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Receiver's Phone Number <span
                                class="text-danger">*</span> </label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-phone bx-sm"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 rounded-0"
                                placeholder=" 09000000000" name="receiver_phone" value="{{ old('receiver_phone') }}"
                                aria-describedby="basic-addon1">

                        </div>

                        @error('receiver_phone')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror

                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Receiver's Address <span
                                class="text-danger">*</span>
                        </label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-location-plus bx-sm"></i></span>
                            <input type="text" class="form-control bg-transparent border-0 rounded-0"
                                placeholder="09000000000" name="receiver_address" value="{{ old('receiver_address') }}"
                                aria-describedby="basic-addon1">
                        </div>
                        @error('receiver_address')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted mb-1 small">Receving Date & Time <span
                                class="text-danger">*</span> </label>
                        <div class="input-group border-bottom">
                            <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                id="basic-addon1"><i class="bx bxs-phone bx-sm"></i></span>
                            <input type="date" class="form-control bg-transparent border-0 rounded-0"
                                placeholder=" 09000000000" name="receiving_date" value="{{ old('receiving_date') }}"
                                aria-describedby="basic-addon1">

                        </div>

                        @error('receiving_date')
                            <i class="text-danger ">{{ $message }} </i>
                        @enderror

                    </div>
                </div>


            </div>

            <div class="footer mt-auto p-3">
                <button type="submit" class="btn btn-primary btn-lg w-100"> Create Order</button>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
    <script>
        $(function() {

            $('input[name="phone"]').on('change', function() {
                phone = $(this).val();
                err = $('.phone_error');
                form = $('#order-form');

                console.log(phone);

                $.ajax({
                    method: 'post',
                    url: '/api/validate-customer-phone',
                    data: {
                        phone: phone
                    }
                }).done(function(res) {

                    console.log(res);
                    err.addClass('text-success');
                    err.removeClass('text-danger');
                    err.html(`Customer Validated <b>${res.customer.name}</b> `);
                    form.find('button').removeAttr('disabled');

                }).fail(function(res) {
                    console.log(res);
                    form.find('button').attr('disabled', 'disabled');
                    err.removeClass('text-success');
                    err.addClass('text-danger');
                    err.html('Customer with phone number does not exist');
                })
            })
        })
    </script>
@endpush
