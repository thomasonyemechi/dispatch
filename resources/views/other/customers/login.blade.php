<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <title> Customer | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vender/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ asset('assets/unpkg.com/boxicons%402.1.4/css/boxicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vender/sidebar/demo.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @laravelPWA
</head>

<body>
    <div class="log-in p-4">
        <div class="d-flex align-items-start justify-content-between mb-4">
            <div>
                <h2 class="fw-bold text-primary">Welcome<br> back!</h2>
            </div>
        </div>
        <form action="{{ route('auth.customer-login') }}" method="post">@csrf

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



            <div class="mb-2">
                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}"
                    placeholder="09012345678">
                @error('phone')
                    <i class="text-danger ">{{ $message }} </i>
                @enderror
            </div>
            <button class="btn btn-primary btn-lg w-100">Log In</button>
        </form>
    </div>

    <div class="footer fixed-bottom p-4">

        <p class="text-muted text-center m-0"><a href="/login">Staff Login</a></p>
    </div>


    <script src="{{ asset('assets/vender/bootstrap/js/bootstrap.bundle.min.js') }}" type="8525e223f2d64fd20337808b-text/javascript"></script>

    <script src="{{ asset('assets/vender/jquery/jquery.min.js') }}" type="8525e223f2d64fd20337808b-text/javascript"></script>

    <script src="{{ asset('assets/vender/sidebar/hc-offcanvas-nav.js') }}" type="8525e223f2d64fd20337808b-text/javascript"></script>

    <script src="{{ asset('assets/js/script.js') }}" type="8525e223f2d64fd20337808b-text/javascript"></script>
    <script src="{{ asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="8525e223f2d64fd20337808b-|49" defer></script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"80ca31cceb590e88","version":"2023.8.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>
