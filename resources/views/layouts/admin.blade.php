
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>
        {{ $title }}
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="/temp/paper-dashboard-master/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/temp/paper-dashboard-master/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/temp/paper-dashboard-master/assets/demo/demo.css" rel="stylesheet" />
    @stack('styles')
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="/temp/paper-dashboard-master/assets/img/logo-small.png">
                    </div>
                    <!-- <p>CT</p> -->
                </a>
                <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                    <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            @include('partials/sidebar')
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            @include('partials/navbar')
            <!-- End Navbar -->
            <div class="content">
                @yield('content')
                
            </div>
            <footer class="footer footer-black  footer-white ">
                <div class="container-fluid">
                    <div class="row">
                        
                        <div class="credits ml-auto">
                            <span class="copyright">
                                © <script>
                                    document.write(new Date().getFullYear())
                                </script>, made with <i class="fa fa-heart heart"></i> by Creative Tim
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="/temp/paper-dashboard-master/assets/js/core/jquery.min.js"></script>
    <script src="/temp/paper-dashboard-master/assets/js/core/popper.min.js"></script>
    <script src="/temp/paper-dashboard-master/assets/js/core/bootstrap.min.js"></script>
    <script src="/temp/paper-dashboard-master/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    
    <script src="/temp/paper-dashboard-master/assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="/temp/paper-dashboard-master/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/temp/paper-dashboard-master/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
   
    <script>
      
   
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});
    function mynotif(message) {
        $.notify({
        icon: "nc-icon nc-bell-55",
        message: message
        
        }, {
        type: 'primary',
        timer: 8000,
        placement: {
        from: 'bottom',
        align: 'left'
        }
        });
    }
    @if (session()->has('success')) mynotif('{{ session('success') }}') @endif
    @if (session()->has('error')) mynotif('{{ session('error') }}') @endif
    </script>
    @stack('scripts')
</body>

</html>