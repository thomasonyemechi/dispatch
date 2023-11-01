<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    {{-- <meta name="keywords" content="school, Standard Academy, education, academy, Akure, Best, Primary school," > --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title Here -->
    <title>{{ env('APP_NAME') }}</title>

    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/favicon.png') }}">
    <link href="{{ asset('admin/vendor/wow-master/css/libs/animate.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('admin/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

    @laravelPWA

</head>

@php
    $user = auth()->user();
    $role = $user->role;
@endphp


<body data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="color_2"
      data-headerbg="color_1" data-sidebar-style="full" data-sidebarbg="color_2" data-sidebar-position="fixed"
      data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1">


{{--
<div id="preloader">
  <div class="loader">
    <div class="dots">
          <div class="dot mainDot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
          <div class="dot"></div>
    </div>
    </div>
</div> --}}

<div id="main-wrapper">


    <div class="nav-header">
        <a href="/admin/dashboard" class="brand-logo">
            <img class="logo- img-fluid rounded" src="{{ asset('logo.png') }}" alt="">
            {{--
            <div class="brand-title">
                <h3 class="text-white mt-3 inline-block" style="line-height: 23px">Dispatch</h3>
            </div> --}}
        </a>


        <div class="nav-control">
            <div class="hamburger">
                <span class="line"></span><span class="line"></span><span class="line"></span>
                <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <rect x="22" y="11" width="4" height="4" rx="2"
                          fill="#2A353A"/>
                    <rect x="11" width="4" height="4" rx="2" fill="#2A353A"/>
                    <rect x="22" width="4" height="4" rx="2" fill="#2A353A"/>
                    <rect x="11" y="11" width="4" height="4" rx="2"
                          fill="#2A353A"/>
                    <rect x="11" y="22" width="4" height="4" rx="2"
                          fill="#2A353A"/>
                    <rect width="4" height="4" rx="2" fill="#2A353A"/>
                    <rect y="11" width="4" height="4" rx="2" fill="#2A353A"/>
                    <rect x="22" y="22" width="4" height="4" rx="2"
                          fill="#2A353A"/>
                    <rect y="22" width="4" height="4" rx="2" fill="#2A353A"/>
                </svg>
            </div>
        </div>
    </div>


    <div class="header">
        <div class="header-content">
            <nav class="navbar navbar-expand">
                <div class="collapse navbar-collapse justify-content-between">
                    <div class="header-left">
                        <div class="dashboard_bar">
                            @yield('page_title')
                        </div>
                    </div>
                    <ul class="navbar-nav header-right">

                        <li class="nav-item">
                            <div class="dropdown header-profile2">
                                <a class="nav-link ms-0" href="javascript:void(0);" role="button"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="header-info2 d-flex align-items-center">
                                        <div class="d-flex align-items-center sidebar-info">

                                        </div>
                                        <img src="{{ asset($user->photo) }}" alt="">
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end pb-0" style="">
                                    <div class="card mb-0">
                                        <div class="card-header p-3">
                                            <ul class="d-flex align-items-center">
                                                <li>
                                                    <img src="{{ asset($user->photo) }}" class="ms-0"
                                                         alt="">
                                                </li>
                                                <li class="ms-2">
                                                    <h4 class="mb-0">{{ $user->name }} </h4>
                                                    <span>{{ $user->role }}</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-body p-3">
                                            <a href="/admin/staff/{{ $user->id }}"
                                               class="dropdown-item ai-icon ">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1"
                                                     class="svg-main-icon">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                       fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                        <path
                                                            d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                        <path
                                                            d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                                            fill="var(--primary)" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
                                                <span class="ms-2">Profile </span>
                                            </a>

                                        </div>
                                        <div class="card-footer text-center p-3">
                                            <a href="/logout" class="dropdown-item ai-icon btn btn-primary light">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                     height="18" viewBox="0 0 24 24" fill="none"
                                                     stroke="var(--primary)" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                                    <polyline points="16 17 21 12 16 7"></polyline>
                                                    <line x1="21" y1="12" x2="9"
                                                          y2="12">
                                                    </line>
                                                </svg>
                                                <span class="ms-2 text-primary">Logout </span>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

    </div>

    <div class="dlabnav">
        <div class="dlabnav-scroll">
            <ul class="metismenu" id="menu">
                <li><a class="" href="/admin/dashboard" aria-expanded="false">
                        <i class="material-symbols-outlined">home</i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <span class="nav-text">Manage Staff</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="/admin/add-staff">Add Staff</a></li>
                        <li><a href="/admin/staff-list">Staff List</a>
                        </li>
                    </ul>
                </li>


                <li>
                    <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                        <i class="material-icons">person</i>
                        <span class="nav-text">Customers</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="#">Customer List</a></li>
                        <li><a href="#">Orders</a>
                        </li>
                    </ul>
                </li>


            </ul>
            <div class="copyright">
                <p><strong>Dashboard</strong></p>
                <p class="fs-12">Made with <span class="heart"></span> by bitech</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div id="refresh" class="alert al_bg"
             style="position:fixed; top:10px; right:10px; z-index:10000; width: auto;">
            <i class="text-white">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                @endforeach
            </i>
        </div>
    @endif


    <div class="content-body">
        <div class="container-fluid">
            @yield('page_content')
        </div>
    </div>


    <div class="footer footer-outer" style="width: 100%">
        <div class="copyright text-center">
            <p>Copyright © Designed &amp; Developed by <a href="/">bitech</a> {{ date('Y') }}</p>
        </div>
    </div>

</div>


<script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>


<script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('admin/vendor/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/vendor/wow-master/dist/wow.min.js') }}"></script>
{{-- <script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script> --}}
<script src="{{ asset('admin/js/dlabnav-init.js') }}"></script>
<script src="{{ asset('admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/general.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


@if (session('error'))
    <script>
        Toastify({
            text: "<?= session('error') ?>",
            duration: 5000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #b04300, #ff0000)",
            },
        }).showToast();
    </script>
@endif

@if (session('success'))
    <script>
        Toastify({
            text: "<?= session('success') ?>",
            duration: 5000,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "linear-gradient(to right, #00b09b, #01ff01)",
            },
        }).showToast();
    </script>
@endif

<script>
    $(function () {
        setTimeout(() => {
            $('#refresh').hide('slow');
        }, 5000);
    })
</script>
@stack('scripts')
</body>

</html>
