<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/temp/skydash/vendors/feather/feather.css">
    <link rel="stylesheet" href="/temp/skydash/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/temp/skydash/vendors/css/vendor.bundle.base.css">
    <link type="text/css" href="/plugin/keypad/css/jquery.keypad.css" rel="stylesheet">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/temp/skydash/css/vertical-layout-light/style.css">

    <link rel="shortcut icon" href="/temp/skydash/images/favicon.png" />
    <style>
        #map {
            height: 200px;
            border: 2px solid;
            border-top-left-radius: 30px;
                border-top-right-radius: 30px;
            }
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">

                <div class="row flex-grow">

                    <div class="col-lg-7 mx-auto text-white">
                        <div class="row align-items-center d-flex flex-row">
                            <div class="col-lg-6 text-lg-right pr-lg-4">
                                <img class="display-1 mb-0 img-fluid" style="width: inherit;border-radius: 48px;" src="/img/attandance.png"/>
                            </div>
                            <div class="col-lg-6 error-page-divider text-lg-left pl-lg-4">
                                <h2>HI {{ $employee->name }}!</h2>
                                <h3 class="font-weight-light">Please select the attendance menu below.</h3>
                                <div>
                                    <a id="permit" href="#permit" title="Izin"><img src="/img/permit.png" height="120" width="125" alt="Izin" style="
                                    border-radius: 44px;
                                    border: 2px solid;
                                    background: #fff;
                                "></a>
                                    <a id="att" href="#att" title="Absen"><img src="/img/att.png" height="120" width="125" alt="Absen" style="
                                    border-radius: 44px;
                                    border: 2px solid;
                                    background: #fff;
                                "></a>
                                </div>

                            </div>
                        </div>
                        @if (session()->has('success'))
                        <div class="row mt-5">
                            <div class="col-12 text-center mt-xl-2">
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading" style="color: #fff;">Information !</h4>
                                    <p style="color: #fff;">{{ session('success') }}</p>

                                </div>
                            </div>
                        </div>
                         @endif
                         @if($errors->any())
                         <div class="row mt-5">
                            <div class="col-12 text-center mt-xl-2">
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading" style="color: #fff;">Error !</h4>
                                    @foreach ($errors->all() as $error)
                                    <p style="color: #fff;">{{ $error }}</p>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                       @endif
                        <div class="row mt-5">
                            <div class="col-12 text-center mt-xl-2">
                                    <iframe  id="map" src="" width="100%" height="200"
                                    frameborder="0" style="border:0"></iframe>
                                <div class="alert alert-success" role="alert" style="border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;">
                                    <h4 class="alert-heading" style="color: #fff;">Information !</h4>
                                    <div id="info" style="color: #fff;"></div>

                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12 text-center mt-xl-2">
                                <a class="text-white font-weight-medium" href="/">Back to home</a>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-12 mt-xl-2">
                                <p class="text-white font-weight-medium text-center">Copyright &copy; 2021 All rights
                                    reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <div class="modal" id="myModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-sample" autocomplete="off" action="{{ route('attandance.store') }}" method="POST">
                        @csrf
                        @include('admin.attandance._form')


                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="/temp/skydash/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/temp/skydash/js/off-canvas.js"></script>
    <script src="/temp/skydash/js/hoverable-collapse.js"></script>
    <script src="/temp/skydash/js/template.js"></script>
    <script src="/temp/skydash/js/settings.js"></script>
    <script src="/temp/skydash/js/todolist.js"></script>
    <script type="text/javascript" src="/plugin/keypad/js/jquery.plugin.js"></script>
    <script type="text/javascript" src="/plugin/keypad/js/jquery.keypad.js"></script>
    <script>
        function showPosition() {
            if(navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude =position.coords.longitude;
                    $('iframe').attr('src',`https://maps.google.com/maps?q=${latitude}, ${longitude}&z=15&output=embed`)
                    let msg=`Anda berada diluar radius {{ radius() }} Meter dari Kantor.. Anda hanya bisa Izin saja.`;
                    console.log('A geolocate event has occurred.');
                    console.log("lng:" + longitude + ", lat:" + latitude);
                    let lat=encodeURIComponent(latitude);
                    let long=encodeURIComponent(longitude);
                    $('#lat').val(lat);
                    $('#lng').val(long);
                    $.get(`/ceklocation?lat=${lat}&long=${long}`,function(data){
                        if(msg==data){
                            $('#att').hide()
                        }
                        $('#info').html(data);
                    });
                });
            } else {
            alert("Sorry, your browser does not support HTML5 geolocation.");
            }
        }

        $('#pin').keypad();
       showPosition()



    </script>
    <script>
        $(document).on('click','#permit',function(e){
            e.preventDefault();
            $('.modal-title').text('Izin');
            $('#type').val('2');
            $('.notes').show();
            $('.absen').hide();
            $('#myModal').modal('show');
        })
        $(document).on('click','#att',function(e){
            e.preventDefault();
            $('.modal-title').text('Absen Kehadiran');
            $('#type').val('5');
            $('.notes').hide();
            $('.absen').show();
            $('#myModal').modal('show');
        })
    </script>
    <!-- endinject -->
</body>

</html>
