@extends('layouts.admin')

@section('page_title')
    Staff List
@endsection
@section('page_content')
    <link href="{{ asset('assets/vendor/bootstrap-datepicker-master/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">


    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <!-- Row -->
                    <div class="row">
                        <!--column-->
                        <div class="col-xl-12">
                            <div class="page-title flex-wrap">
                                <form action="">
                                    <div class="input-group search-area mb-md-0 mb-3">

                                        <input type="text" name="staff" class="form-control" placeholder="Search teacher here...">
                                        <span class="input-group-text"><a href="javascript:void(0)">
                                                <svg width="15" height="15" viewBox="0 0 18 18" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z"
                                                        fill="#01A3FF"></path>
                                                </svg>
                                            </a>
                                        </span>

                                    </div>
                                </form>
                                <div>
                                    <a href="/admin/add-staff" class="btn btn-primary">
                                        + New Staff
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <div class="row">

                                @foreach ($staffs as $staff)
                                    <div class="col-xl-3 col-lg-4 col-sm-6">
                                        <div class="card contact_list text-center">
                                            <div class="card-body">
                                                <div class="user-content">
                                                    <div class="user-info">
                                                        <div class="user-img">
                                                            <img src="{{ asset($staff->photo) }}" alt=""
                                                                class="avatar avatar-xl">
                                                        </div>
                                                        <div class="user-details">
                                                            <h4 class="user-name mb-0">{{ $staff->name }}</h4>
                                                            <p>{{ $staff->role }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contact-icon">
                                                    <span class="badge badge-success light">{{ $staff->phone }}</span>
                                                    <span
                                                        class="badge badge-danger light">{{ date('j M, Y', strtotime($staff->created_at)) }}</span>
                                                </div>
                                                <div class="d-flex justify-content-center ">
                                                    <a href="/admin/staff/{{ $staff->id }}"
                                                        class="btn  btn-primary btn-sm w-50 me-2"><i
                                                            class="fa-solid fa-user me-2"></i>Profile</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <div class="table-pagination d-flex justify-content-end teach">
                        {{ $staffs->links('pagination::bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
@endpush
