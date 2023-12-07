@extends('layouts.other')

@section('page_title')
    Orders
@endsection
@section('page_content')

    @include('other.designers.top')

    <style>

    </style>

    <div class="vh-100 my-auto overflow-auto">


        <div>
            @if (count($orders) == 0)
                <div class="mt-5 d-flex justify-content-center align-items-center centerr">
                    <div class="text-center" style="height: 16rem; width: 17rem;">
                        <span class="text-danger"><i class="bx bx-x-circle" style="font-size: 50px"></i></span>
                        <h6 class="text-center text-muted mt-3 font-900">You have not selected any order to design</h6>
                        <a href="/designer/undesigned" class="">View Marketer Undesigned Orders</a>
                    </div>
                </div>
            @endif
            @foreach ($orders as $order)
                <div
                    class="bg-white rounded-3 shadow d-flex align-items-center justify-content-between p-3 border border mb-2">
                    <div>
                        <span class="fw-bold small">Order #{{ $order->id }}</span>
                        <h6 class="small">{{ $order->service_name }}</h6>
                        <div class="bg-light p-1 rounded">
                            <p class="mb-0 text-muted small">
                                <span class="fw-bold">{{ date('j M, Y', strtotime($order->created_at)) }}</span>
                                <span class="divider"> | </span>
                                <span class="fw-bold"><a href="javascript:;" class="showFilesModal"
                                        data-files={{ $order->files }} data-id={{ $order->id }}>View Files</a></span>
                            </p>
                        </div>

                        @if (!$order->designer_id)
                            <p class="text-danger mt-0 mb-0 small">No designer has started work on this order
                            </p>
                            <form action="/designer/select_design" class="mt-2" method="post">@csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <button class="btn btn-outline-info opacity-75 btn-sm py-0"
                                    onclick="return confirm('This order designs will be assigned to you') ">select
                                    design</button>
                            </form>
                        @endif

                        @php
                            $completed = completeDesign($order->id);
                        @endphp

                        @if ($completed)
                            <p class="text-success mt-0 mb-0 small">Order design has been completed by
                                <span>{{ $order->designer->name }} <a href="javascript:;"
                                        data-files='{{ $completed->files }}' class=" view_order_design fw-bold">See
                                        Design</a>
                                </span>
                            </p>
                        @else
                            @if ($order->designer_id)
                                @if ($order->designer_id == auth()->user()->id)
                                    <button class="btn mt-2 btn-outline-success mark-complete opacity-75 btn-sm py-0"
                                        data-id={{ $order->id }}>mark as
                                        completed</button>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('other.designers.modals')

@endsection


@push('scripts')
    <script>
        $(function() {

            mod = $('#completeModal')

            $('.mark-complete').on('click', function() {
                id = $(this).data('id');
                mod.modal('show');
                mod.find('input[name="id"]').val(id);
            })


            mod.find('.btn-close').on('click', function() {
                mod.modal('hide');
            })


            $('.view_order_design').on('click', function() {

            })


            fileModal = $('#fileModal')
            // fileModal.modal('show')
            $('.showFilesModal').on('click', function() {
                files = $(this).data('files');
                id = $(this).data('id');

                fileModal.find('.modal-title').html(`Order #${id}`)

                body = fileModal.find('.m-body');

                body.html(``);

                if (files.length == 0) {
                    body.html(`
                        <div class="alert alert-warning">
                            couldn't find any uploaded files
                            <br>
                            <span class="mt-2 fw-bold" >
                                Pls Contact to confirm file uploads
                            </span>
                        </div>
                    `)
                } else {


                    files.forEach(file => {

                        body.append(`
                        <div class="mb-2">
                            <div class="d-flex justify-content-between rounded bg-light p-2">
                                <span class="d-flex"><i class="bx me-1 bx-file fs-4 fw-bold"> </i>
                                    <h6 class="mb-0 d-inline mt-1"> ${file} </h6>
                                </span> <span><a href="javascript:;"> <i class="bx bx-cloud-download fs-4 fw-bold"></i>
                                    </a></span>
                            </div>
                        </div>
                    `)
                    });


                }

                fileModal.modal('show')
            })
            fileModal.find('.btn-close').on('click', function() {
                fileModal.modal('hide');
            })


        })
    </script>
@endpush