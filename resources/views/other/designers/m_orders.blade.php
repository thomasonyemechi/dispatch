@extends('layouts.other')

@section('page_title')
    Orders
@endsection
@section('page_content')
    <link rel="stylesheet" href="{{ asset('custom-style.css') }}">

    <div class="home-navbar bg-primary d-flex align-items-center gap-3 mb-auto p-3 osahan-header">
        <img src="{{ asset('assets/img/my-profile.jpg') }}" alt class="img-fluid rounded-pill profile">
        <div>
            <small class="mb-1 text-white-50"> {{ auth()->user()->phone }} </small>
            <h6 class="fw-bold text-white mb-0"> {{ auth()->user()->name }} </h6>
        </div>

        <div class="d-flex align-items-center gap-3 ms-auto">
            <a href="javasctipt:;" class="bg-white shadow rounded-pill notification-icon position-relative">
                <i class="bx bxs-bell h5 m-0 text-primary"></i>
                <span
                    class="position-absolute top-0 ms-5 mt-1 translate-middle badge rounded-circle bg-danger py-1 fw-normal">
                    3
                    <span class="visually-hidden">unread messages</span>
                </span>
            </a>
        </div>
    </div>





    <div class="vh-100 my-auto overflow-auto">

        <div class="border-bottom bg-white p-3 mb-3 rounded d-flex align-items-center ">
            <img src="{{ asset($marketer->photo) }}" alt="" class="img-fluid me-2 rounded-lg profile">
            <div>
                <h6 class="mb-1">{{ $marketer->name }} </h6>
                <a href="javasript:;">{{ $marketer->phone }} </a>
            </div>
        </div>

        <div>
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


                        @if ($order->log ?? 0)


                        @else
                            @if ($order->designer_id)
                                <p class="text-info mt-0 mb-0 small">Design was sslected by <span
                                        class="fw-bold">{{ $order->designer->name }}</span> </p>
                                @if ($order->designer_id == auth()->user()->id)
                                    <button class="btn btn-outline-success mark-complete opacity-75 btn-sm py-0"
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

    <div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex mb-3 justify-content-between ">
                        <h5 class="modal-title medium">Order Files</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="m-body">


                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex mb-3 justify-content-between ">
                        <h5 class="modal-title medium">Complete Design</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        </button>
                    </div>

                    <div class="m-body">
                        <div class="alert alert-success">
                            Congratulations on completing this order designs
                        </div>

                        <div class="alert alert-warning">
                            Please upload design files if available
                        </div>

                        <form action="/designer/complete_design" class="row" method="POST"
                            enctype="multipart/form-data">@csrf
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label text-muted mb-1 small">Upload File</label>
                                    <div class="input-group border-bottom">
                                        <span class="input-group-text bg-transparent rounded-0 border-0 text-muted px-0"
                                            id="basic-addon1"><i class="bx bxs-file bx-sm"></i></span>
                                        <input type="hidden" name="id">
                                        <input type="file" class="form-control bg-transparent border-0 rounded-0"
                                            placeholder="" name="files[]" aria-describedby="basic-addon1" multiple>

                                    </div>

                                    @error('files')
                                        <i class="text-danger ">{{ $message }} </i>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end ">
                                    <button class="btn btn-success btn-sm">Mark as complete</button>
                                </div>
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

            ////    //complete modal


            $('.mark-complete').on('click', function() {
                id = $(this).data('id');
                mod = $('#completeModal')
                mod.modal('show');
                mod.find('input[name="id"]').val(id);
            })



            fileModal = $('#fileModal')
            // fileModal.modal('show')
            $('.showFilesModal').on('click', function() {
                files = $(this).data('files');
                id = $(this).data('id');

                fileModal.find('.modal-title').html(`Order #${id}`)

                body = fileModal.find('.m-body');

                if (files.length == 0) {
                    body.html(`
                        <div class="alert alert-warning">
                            couldn't find any uploaded files
                            <br>
                            <span class="mt-2 fw-bold" >
                                Pls Contact Markter to confirm file uploads
                            </span>
                        </div>
                    `)
                }

                fileModal.modal('show')
            })
            fileModal.find('.btn-close').on('click', function() {
                fileModal.modal('hide');
            })


        })
    </script>
@endpush
