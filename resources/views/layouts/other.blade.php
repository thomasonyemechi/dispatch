<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/png">
    <title> @yield('page_title') | {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vender/bootstrap/css/bootstrap.min.css') }}">

    <link href="{{ asset('assets/unpkg.com/boxicons%402.1.4/css/boxicons.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/vender/sidebar/demo.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @laravelPWA

    @if(auth()->guard('customers')->check())
        <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
        <script>
            const firebaseConfig = {
                apiKey: "AIzaSyBPUu2gtAXh0PMJxU_d7LqzyP8zqz5WwvQ",
                authDomain: "uniquedispatch-b5f9c.firebaseapp.com",
                projectId: "uniquedispatch-b5f9c",
                storageBucket: "uniquedispatch-b5f9c.appspot.com",
                messagingSenderId: "199811555603",
                appId: "1:199811555603:web:dde058c0067b1e9c1afae6",
                measurementId: "G-2WKBMT7CB7"
            };
            firebase.initializeApp(firebaseConfig);
            const messaging = firebase.messaging();
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            // Check if the browser supports the Notification API
            if ('Notification' in window) {
                startFCM()
            }

            function startFCM() {
                const userId = "{{auth()->guard('customers')->user()->id}}"; // Get the user's identifier (e.g., user ID)
                const storedToken = localStorage.getItem(`fcmToken_${userId}`); // Check if user-specific token is already stored
                if (storedToken) {
                    // Token is already stored for the user, no need to generate it again
                    console.log('Using stored FCM token for user:', userId, storedToken);
                } else {
                    messaging
                        .requestPermission()
                        .then(function () {
                            return messaging.getToken()
                        })
                        .then(function (response) {
                            localStorage.setItem(`fcmToken_${userId}`, response);
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: '{{ route("customer.store.token") }}',
                                type: 'POST',
                                data: {
                                    token: response
                                },
                                dataType: 'JSON',
                                success: function (response) {
                                    console.log('Token stored.');
                                },
                                error: function (error) {
                                    console.log(error);
                                },
                            });

                        }).catch(function (error) {
                        console.log(error);
                    });
                }
            }

            messaging.onMessage(function (payload) {
                const title = payload.notification.title;
                const options = {
                    body: payload.notification.body,
                    icon: payload.notification.icon,
                };
                new Notification(title, options);
            });

            // function requestPermission() {
            //     Notification.requestPermission().then(function (permission) {
            //         if (permission === 'granted') {
            //             console.log('Notification permission granted.');
            //             navigator.serviceWorker.ready.then((sw) => {
            //                 sw.pushManager.subscribe({
            //                     userVisibleOnly: true,
            //                     applicationServerKey: "BJDW9HOwrQERdLDMpsRsf241bvX-KGe04dddndEKgPJfXrD6NzGuj-0jeF5X3Xb66lza_JE6IeuSQn2B1vKQqoo"
            //                 }).then((subscription) => {
            //                     fetch("/customer/save-subscription", {
            //                         method: "POST",
            //                         headers: {
            //                             "Content-Type": "application/json",
            //                             'X-CSRF-TOKEN': csrfToken,
            //                         },
            //                         body: JSON.stringify(subscription)
            //                     }).then((res) => {
            //                         console.log(res)
            //                     }).catch((err) => {
            //                         console.log(err)
            //                     })
            //                 }).catch((err) => {
            //                     console.log(err)
            //                 })
            //             })
            //         } else {
            //             console.log('Unable to get permission to notify.');
            //         }
            //     });
            // }
            //
            function tokenExists() {
                return fetch("/customer/check-token", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        'X-CSRF-TOKEN': csrfToken,
                    },
                })
                    .then((response) => {
                        if (response.ok) {
                            return response.json().then((data) => {
                                return data.exists; // true if subscription exists, false if it doesn't
                            });
                        } else {
                            console.error("Error checking token:", response.statusText);
                            return false; // Handle the error as needed
                        }
                    })
                    .catch((error) => {
                        console.error("Error checking token:", error);
                        return false; // Handle the error as needed
                    });
            }

            //
            //
            // function deleteSubscription(userIdentifier) {
            //     fetch("/customer/delete-subscription", {
            //         method: "POST",
            //         headers: {
            //             "Content-Type": "application/json",
            //             'X-CSRF-TOKEN': csrfToken,
            //         },
            //         body: JSON.stringify({userIdentifier})
            //     })
            //         .then((res) => {
            //             if (res.ok) {
            //                 console.log("Subscription deleted successfully.");
            //             } else {
            //                 console.log("Error deleting subscription:", res.statusText);
            //                 // Handle the error as needed, and consider whether to call requestPermission() here.
            //             }
            //         })
            //         .catch((err) => {
            //             console.log("Error deleting subscription:", err);
            //             // Handle the error as needed, and consider whether to call requestPermission() here.
            //         });
            // }

        </script>
    @endif
</head>

<body>


<div class="home d-flex flex-column vh-100">
    @if ($errors->any())
        <div id="refresh" class="alert"
             style="position:fixed; top:10px; right:10px; z-index:10000; width: auto;">
            <i class="text-white">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br/>
                @endforeach
            </i>
        </div>
    @endif




    @yield('page_content')



    @if (Auth::guard('customers')->user())
        @include('other.customers.customer-footer')
    @endif




        @if (auth()->user()->role == 'marketer')
            <div class="footer mt-auto osahan-footer bg-white shadow">
                <div class="d-flex align-items-center justify-content-between bottom-nav-main">
                    <a href="/staff/create-order" class="col text-muted text-center">
                        <i class="bx bx-plus-circle bx-sm"></i>
                        <p class="small m-0">New Order</p>
                    </a>
                    <a href="/staff/orders" class="col text-muted text-center">
                        <i class="bx bx-list-ul bx-sm"></i>
                        <p class="small m-0">Orders</p>
                    </a>
                    <a href="/staff/customer-list" class="col text-muted text-center">
                        <i class="bx bxs-user bx-sm"></i>
                        <p class="small m-0">Customers</p>
                    </a>
                </div>
            </div>
        @endif



        <nav id="main-nav">
            <ul class="second-nav">


                @if (auth()->user()->role == 'marketer')
                    <li><a href="/staff/dashboard"><i class="bx bxs-home me-2"></i>Dashboard</a></li>
                    <li><a href="/staff/add-customer"><i class="bx bxs-home me-2"></i>Add Customer</a></li>
                    <li><a href="/staff/orders"><i class="bx bxs-home me-2"></i>Orders</a></li>
                    <li><a href="/staff/customer-list"><i class="bx bxs-home me-2"></i>Customer List</a></li>
                    <li><a href="/staff/create-order"><i class="bx bxs-home me-2"></i>Create New Order</a></li>
                @endif

            </ul>
            <ul class="bottom-nav">
                <li class="home">
                    <a href="/staff/orders" class="text-primary">
                        <p class="h5 m-0"><i class="bx bxs-home"></i></p>
                        Home
                    </a>
                </li>
                <li class="more">
                    <a href="#">
                        <p class="h5 m-0"><i class="bx bxs-grid-alt"></i></p>
                        More
                    </a>
                </li>
            </ul>
        </nav>


    </div>


<script src="{{ asset('assets/vender/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/vender/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('assets/vender/sidebar/hc-offcanvas-nav.js') }}"></script>

<script src="{{ asset('assets/js/script.js') }}"></script>


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
