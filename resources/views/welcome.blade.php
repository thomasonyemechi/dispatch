<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
    <title> Customer | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vender/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ asset('assets/unpkg.com/boxicons%402.1.4/css/boxicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vender/slick/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vender/slick/slick/slick-theme.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @laravelPWA
</head>

<body>




    <div class="landing">
        <div class="landing-slider">
            <div class="landing-item">
                <h4 class="fw-bold px-4 pb-0 pt-5 mb-0 text-center text-primary">Order for product and pay on delivery!</h4>
                <img src="{{ asset('assets/img/landing-1.svg') }}" alt class="img-fluid">
            </div>
            <div class="landing-item">
                <h4 class="fw-bold px-4 pb-0 pt-5 mb-0 text-center text-primary">We offer professional graphics design services!
                </h4>
                <img src="{{ asset('assets/img/landing-2.svg') }}" alt class="img-fluid">
            </div>
            <div class="landing-item">
                <h4 class="fw-bold px-4 pb-0 pt-5 mb-0 text-center text-primary">We provide the best printing services</h4>
                <img src="{{ asset('assets/img/landing-3.svg') }}" alt class="img-fluid">
            </div>
        </div>
    </div>

    <div class="footer fixed-bottom p-3">
        <div class="d-flex gap-3 mb-3">
            <a href="/customer-login" class="btn btn-outline-primary btn-lg col">Customer Login</a>
            <a href="/login" class="btn btn-primary btn-lg col">Staff Login</a>
        </div>
        <p class="text-muted text-center m-0">Contact Admin <a href="#">here</a></p>
    </div>




    <script src="{{ asset('assets/vender/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vender/jquery/jquery.min.js') }}" ></script>
   <script src="{{ asset('assets/vender/slick/slick/slick.min.js') }}" ></script>

    <script src="{{ asset('assets/vender/sidebar/hc-offcanvas-nav.js') }}" ></script>
 
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="8525e223f2d64fd20337808b-|49" defer></script>
    {{-- <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"
        integrity="sha512-bjgnUKX4azu3dLTVtie9u6TKqgx29RBwfj3QXYt5EKfWM/9hPSAI/4qcV5NACjwAo8UtTeWefx6Zq5PHcMm7Tg=="
        data-cf-beacon='{"rayId":"80ca31cceb590e88","version":"2023.8.0","r":1,"b":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}'
        crossorigin="anonymous"></script> --}}
</body>

</html>
