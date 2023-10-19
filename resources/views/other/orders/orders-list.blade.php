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


        @foreach ($orders as $order)
            <a href="/staff/customer/{{ $cus->id }}" class="link-dark">
                <div
                    class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                    <div>
                        <h6 class="mb-1"> {{ $cus->name }} </h6>
                        <p class="mb-1 text-muted small">Added {{ date('j M, Y H:i a', strtotime($cus->created_at)) }} |
                            by
                            {{ $cus->user->name }} </p>
                        <p class="fw-bold text-success small m-0">Active</p>
                    </div>
                    <img src="{{ asset($cus->photo) }}" alt="" class="img-fluid rounded-pill profile">
                </div>
            </a>
        @endforeach

        <div class="pt-3 d-flex justify-content-end ">
            {{ $customers->links('pagination::bootstrap-4') }}
        </div>

    </div>
@endsection


@push('scripts')
@endpush
