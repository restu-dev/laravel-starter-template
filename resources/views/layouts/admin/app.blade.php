<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Starter | {{ session('url_aktif') }}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('assets/img/icon.ico') }}" type="image/x-icon" />

    @yield('css')
    
    <!-- Fonts and icons -->
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['../assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/atlantis.min.css') }}">

    {{-- select2 --}}
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2-bootstrap4.min.css') }}">

</head>

{{-- <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Tables - Atlantis Lite Bootstrap 4 Admin Dashboard</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="/assets/img/icon.ico" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ['/assets/css/fonts.min.css']
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">
</head> --}}

<body data-background-color="blue2">
    <div class="wrapper sidebar_minimize">

        <div class="main-header">

            <!-- Logo Header -->
            @include('layouts.admin.partials.logo-header')
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            @include('layouts.admin.partials.navbar')
            <!-- End Navbar -->

        </div>

        <!-- Sidebar -->
        @include('layouts.admin.partials.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">

                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">{{ $title }}</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="#">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void(0)">{{ Request::segment(1) }}</a>
                            </li>
                            @if (Request::segment(2) != '')
                                <li class="separator">
                                    <i class="flaticon-right-arrow"></i>
                                </li>
                                <li class="nav-item">
                                    <a href="javascript:void(0)">{{ Request::segment(2) }}</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    @yield('content')
                </div>

            </div>

            @include('layouts.admin.partials.footer')

        </div>

    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>

    {{-- select2 --}}
    <script src="{{ asset('assets/select2/js/select2.full.min.js') }}"></script>


    <script>
        $('.select2').select2()

        function tampilPesan(state, icon, title, message) {
            var placementFrom = 'top';
            var placementAlign = 'right';
            var state = state;
            var style = 'withicon';
            var content = {};

            content.title = title;
            content.message = message;
            if (style == "withicon") {
                content.icon = icon;
            } else {
                content.icon = 'none';
            }

            // content.url = 'index.html';
            // content.target = '_blank';

            $.notify(content, {
                type: state,
                placement: {
                    from: placementFrom,
                    align: placementAlign
                },
                time: 10,
                delay: 1,
            });
        }
    </script>

    @yield('script')

</body>

</html>
