<!DOCTYPE html>
<html lang="en">

<head>
    <title>Coffee - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/animate.css">

    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/magnific-popup.css">

    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/aos.css">

    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/ionicons.min.css">

    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/flaticon.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/icomoon.css">
    <link rel="stylesheet" href="/temp/coffee1-gh-pages/css/style.css">
    <link href="{{ asset('plugin/jquery-toast/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="/">{{ setdata()->appname }}<small class="d-none">Blend</small></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="/" class="nav-link">Menu</a></li>
                    <li class="nav-item cart"><a href="{{ route('cart.list') }}" class="nav-link"><span
                                class="icon icon-shopping_cart"></span><span
                                class="bag d-flex justify-content-center align-items-center"><small>{{ Cart::getTotalQuantity()}}</small></span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->


@yield('content')
    



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>


    <script src="/temp/coffee1-gh-pages/js/jquery.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/popper.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/bootstrap.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.easing.1.3.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.waypoints.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.stellar.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/owl.carousel.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.magnific-popup.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/aos.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.animateNumber.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/bootstrap-datepicker.js"></script>
    <script src="/temp/coffee1-gh-pages/js/jquery.timepicker.min.js"></script>
    <script src="/temp/coffee1-gh-pages/js/scrollax.min.js"></script>
  
    <script src="/temp/coffee1-gh-pages/js/main.js"></script>
    <script src="{{ asset('plugin/jquery-toast/dist/jquery.toast.min.js') }}"></script>
    <script>
        function notifToast(text,type){
        $.toast({
        heading: 'Information',
        text: text,
        hideAfter : 10000,
        icon: type,
        loader: true, // Change it to false to disable loader
        loaderBg: '#9EC600' // To change the background
        })
        }
        @if (session()->has('success')) notifToast('{{ session('success') }}','info') @endif
        @if (session()->has('error')) notifToast('{{ session('error') }}','error') @endif
    </script>
    @stack('scripts')
    

</body>

</html>