@extends('layouts.other')

@section('page_title')
    Dashboard
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> Add Customer </h5>
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
        <form action="/staff/add-customer" method="POST">
            @csrf
            <div class="vh-100 my-auto overflow-auto p-3">

                <div class="mb-3">
                    <label class="form-label text-muted mb-1 small">Customer's Phone Number <span
                            class="text-danger">*</span> </label>
                    <div class="input-group border-bottom">
                        <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                            id="basic-addon1"><i class="bx bxs-phone bx-sm"></i></span>
                        <input type="text" class="form-control bg-transparent border-0 rounded-0"
                            placeholder=" 09000000000" name="phone" value="{{ old('phone') }}" aria-describedby="basic-addon1">

                    </div>

                    @error('phone')
                        <i class="text-danger ">{{ $message }} </i>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label text-muted mb-1 small">Customer Name <span class="text-danger">*</span></label>
                    <div class="input-group border-bottom">
                        <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                            id="basic-addon1"><i class="bx bxs-user bx-sm"></i></span>
                        <input type="text" class="form-control bg-transparent border-0 rounded-0"
                            placeholder="Customer Name" name="name" value="{{ old('name') }}" aria-describedby="basic-addon1">

                    </div>

                    @error('name')
                        <i class="text-danger ">{{ $message }} </i>
                    @enderror
                </div>


                <div class="mb-3">
                    <label class="form-label text-muted mb-1 small">Customer Address <span
                            class="text-danger">*</span></label>
                    <div class="input-group border-bottom">
                        <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                            id="basic-addon1"><i class="bx bxs-location-plus bx-sm"></i></span>
                        <input type="text" class="form-control bg-transparent border-0 rounded-0"
                            placeholder="lagos nigeria" name="address" value="{{ old('address') }}" aria-describedby="basic-addon1">

                    </div>
                    @error('address')
                        <i class="text-danger ">{{ $message }} </i>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted mb-1 small">Customer E-Mail </label>
                    <div class="input-group border-bottom">
                        <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                            id="basic-addon1"><i class="bx bxs-envelope bx-sm"></i></span>
                        <input type="email" class="form-control bg-transparent border-0 rounded-0"
                            placeholder="customer@gmail.com" name="email" value="{{ old('email') }}"  aria-label="phone"
                            aria-describedby="basic-addon1">

                    </div>
                    @error('email')
                        <i class="text-danger ">{{ $message }} </i>
                    @enderror
                </div>
            </div>

            <div class="footer mt-auto p-3">
                <button class="btn btn-primary btn-lg w-100"> Add Customer </button>
            </div>
        </form>
    </div>
@endsection


@push('scripts')
@endpush
