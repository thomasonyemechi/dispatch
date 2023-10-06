<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from askbootstrap.com/preview/halping/payment-successful.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 26 Sep 2023 08:40:03 GMT -->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.svg" type="image/png">
    <title> Page Not Found | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vender/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ asset('assets/unpkg.com/boxicons%402.1.4/css/boxicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vender/sidebar/demo.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="paument-successful d-flex align-items-center justify-content-center vh-100">
        <div>
            <img src=" {{ asset('assets/img/errors/404.jpg') }} " alt class="img-fluid w-50 d-block mx-auto">
            <div class="text-center p-4">
                <h5 class="fw-bold">Page Not Found!</h5>
                <p>Oops The Page you are looking for does not exists. </p>

                <button class="btn btn-primary btn-lg px-4"  onclick="history.back()" >Go Back</button>
            </div>
        </div>
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
