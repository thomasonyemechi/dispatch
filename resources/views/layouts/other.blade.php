<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.svg" type="image/png">
    <title> @yield('page_title') | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vender/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ asset('assets/unpkg.com/boxicons%402.1.4/css/boxicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vender/sidebar/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>



    <div class="home d-flex flex-column vh-100">
        @if ($errors->any())
            <div id="refresh" class="alert"
                style="position:fixed; top:10px; right:10px; z-index:10000; width: auto;">
                <i class="text-white">
                    @foreach ($errors->all() as $error)
                        {{ $error }} <br />
                    @endforeach
                </i>
            </div>
        @endif


    

        @yield('page_content')

        {{-- <div class="footer mt-auto osahan-footer bg-white shadow">
            <div class="d-flex align-items-center justify-content-between bottom-nav-main">
                <a href="home.html" class="col text-primary text-center">
                    <i class="bx bxs-home bx-sm"></i>
                    <p class="small m-0">Home</p>
                </a>
                <a href="find.html" class="col text-muted text-center">
                    <i class="bx bx-search bx-sm"></i>
                    <p class="small m-0">Find</p>
                </a>
                <a href="messages.html" class="col text-muted text-center">
                    <i class="bx bxs-message-dots bx-sm"></i>
                    <p class="small m-0">Messages</p>
                </a>
                <a href="requests.html" class="col text-muted text-center">
                    <i class="bx bxs-calendar-check bx-sm"></i>
                    <p class="small m-0">Request</p>
                </a>
                <a href="more.html" class="col text-muted text-center">
                    <i class="bx bxs-grid-alt bx-sm"></i>
                    <p class="small m-0">More</p>
                </a>
            </div>
        </div> --}}




        <nav id="main-nav">
            <ul class="second-nav">
                <li><a href="/staff/dashboard"><i class="bx bxs-home me-2"></i>Dashboard</a></li>
                <li><a href="/staff/add-customer"><i class="bx bxs-home me-2"></i>Add Customer</a></li>
                <li><a href="/staff/customer-list"><i class="bx bxs-home me-2"></i>Customer List</a></li>
                <li><a href="#"><i class="bx bxs-home me-2"></i>Create New Order</a></li>
                <li><a href="#"><i class="bx bxs-home me-2"></i>Created Order</a></li>
                <li><a href="#"><i class="bx bxs-home me-2"></i>Homepage</a></li>
                <li><a href="#"><i class="bx bxs-home me-2"></i>Homepage</a></li>
                <li><a href="#"><i class="bx bxs-home me-2"></i>Homepage</a></li>
                <li><a href="#"><i class="bx bxs-user-circle me-2"></i>My Profile</a></li>
            </ul>
            <ul class="bottom-nav">
                <li class="home">
                    <a href="home.html" class="text-primary">
                        <p class="h5 m-0"><i class="bx bxs-home"></i></p>
                        Home
                    </a>
                </li>
                <li class="find">
                    <a href="find.html">
                        <p class="h5 m-0"><i class="bx bx-search"></i></p>
                        Find
                    </a>
                </li>
                <li class="more">
                    <a href="more.html">
                        <p class="h5 m-0"><i class="bx bxs-grid-alt"></i></p>
                        More
                    </a>
                </li>
            </ul>
        </nav>



    </div>



    <script src="{{ asset('assets/vender/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/vender/jquery/jquery.min.js') }}" ></script>

    <script src="{{ asset('assets/vender/sidebar/hc-offcanvas-nav.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}" ></script>


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>


    @stack('scripts')


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

    {{-- <script>
        $(function() {
            setTimeout(() => {
                $('#refresh').hide('slow');
            }, 5000);
        })
    </script> --}}
</body>

</html>
