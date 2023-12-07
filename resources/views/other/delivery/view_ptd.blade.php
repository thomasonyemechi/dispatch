@php use App\Enums\OrderStatus; @endphp
@extends('layouts.other')

@section('page_title')
    orders
@endsection
@section('page_content')
    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <div>
            <h5 class="fw-bold text-white mb-0"> New Orders </h5>
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

        <div class="alert alert-warning">
            These are the list of orders that has been newly sent from marketers to the delivery department
        </div>

        @foreach ($orders as $order)
            <div class="bg-white rounded-3 shadow align-items-center justify-content-between p-3 border border mb-2">
                <div>
                    <span class="small text-muted ">Services</span>

                    <ul class="fw-bold small mb-1 p-0" style="list-style: none">
                        <li>{{ $order->service_name }}</li>
                    </ul>

                    <p class="mb-1 text-muted rounded d-inline small">
                        <span class="fw-bold"> Created by {{ $order->staff->name }} </span>
                        {{ date('j M, Y', strtotime($order->created_at)) }}
                    </p>

                    <div>
                        <a href="/delivery/ready/{{$order->id}}"  class="bg-secondary p-1 rounded text-white" >ready for delivery</a>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="pt-3 d-flex justify-content-end ">
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>


    </div>
@endsection


@push('scripts')
@endpush
