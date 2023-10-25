<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ env('APP_NAME') }}</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">
    <link href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="body  h-100">
<div class="authincation d-flex flex-column flex-lg-row flex-column-fluid">
    <div class="login-aside text-center  d-flex flex-column flex-row-auto">

    </div>
    <div
        class="container flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
        <div class="d-flex justify-content-center h-100 align-items-center">
            <div class="authincation-content style-2">
                <div class="row no-gutters">
                    <div class="col-xl-12 tab-content">
                        <div id="sign-up" class="auth-form tab-pane fade show active  form-validation">
                            <form action="{{route('auth.customer-login')}}" method="post">@csrf
                                <div class="text-center mb-4">
                                    <h3 class="text-center mb-2 text-black">Customer Sign In</h3>


                                    @if (session('success'))
                                        <div class="mb-2 text-center refresh ">
                                            <i class="text-success "> {{ session('success') }} </i>
                                        </div>
                                    @endif
                                    @if (session('error'))
                                        <div class="mb-2 text-center refresh">
                                            <i class="text-danger"> {{ session('error') }} </i>
                                        </div>
                                    @endif

                                </div>
                                <div class="mb-3">
                                    <label class="form-label mb-2 fs-13 label-color font-w500">Phone</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}"
                                           placeholder="09012345678">
                                    @error('phone')
                                    <i class="text-danger ">{{ $message }} </i>
                                    @enderror
                                </div>
                                <button class="btn btn-block btn-primary">Sign In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="admin/vendor/global/global.min.js"></script>
<script src="admin/js/custom.min.js"></script>
<script src="admin/js/dlabnav-init.js"></script>

</body>

</html>
