<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Portal</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendor/prismjs/themes/prism.css') }}">

    @yield('header')

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/components.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <!-- Navbar -->
            @include('layouts.includes._navbar')

            <!-- Sidebar -->
            @include('layouts.includes._sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        @yield('content')
                    </div>    
                </section>

                @yield('modal')

            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021 <div class="bullet"></div>  Design By IT RSUD Tidar
                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('admin/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/vendor/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/prismjs/prism.js') }}"></script>
    <script src="{{ asset('admin/vendor/cleave.js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/cleave.js/addons/cleave-phone.us.js') }}"></script>
    
    <!-- Template JS File -->
    <script src="{{ asset('admin/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/js/custom.js') }}"></script>

    
    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/js/page/modules-datatables.js') }}"></script>
    <script src="{{ asset('admin/js/page/bootstrap-modal.js') }}"></script>
    <script>
        @if(Session::has('sukses'))
            iziToast.success({
                title: 'Sukses',
                message: '{{ session::get("sukses") }}',
                position: 'topRight'
            });
        @endif

        @if(Session::has('warning'))
            iziToast.warning({
                title: 'Warning',
                message: '{{ session::get("warning") }}',
                position: 'topRight'
            });
        @endif

        @if(Session::has('error'))
            iziToast.error({
                title: 'Error',
                message: '{{ session::get("error") }}',
                position: 'topRight'
            });
        @endif
    </script>

    <script>
        $(function() {
            function timeChecker() {
                setInterval(function() {
                    var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");  
                    timeCompare(storedTimeStamp);
                },10000);
            }

            function timeCompare(timeString) {
                var maxMinutes  = 2;  //GREATER THEN 1 MIN.
                var currentTime = new Date();
                var pastTime    = new Date(timeString);
                var timeDiff    = currentTime - pastTime;
                var minPast     = Math.floor( (timeDiff/60000) ); 

                if( minPast > maxMinutes) {
                    sessionStorage.removeItem("lastTimeStamp");
                    location.href = "{{ route('auto.logout')}}";
                    return false;
                }
                /* else {
                    //JUST ADDED AS A VISUAL CONFIRMATION
                    console.log(currentTime +" - "+ pastTime+" - "+minPast+" min past");
                } */
            }

            if (typeof(Storage) !== "undefined") {
                $(document).mousemove(function() {
                    var timeStamp = new Date();
                    sessionStorage.setItem("lastTimeStamp",timeStamp);
                });

                timeChecker();
            }  
        });//END JQUERY
    </script>

    @yield('footer')
</body>

</html>
