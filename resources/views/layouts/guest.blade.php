<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | PPDB SMA Perintis 2</title>

    @stack('styles')

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Alpine Js-->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

    </style>

    @livewireStyles
</head>

<body class="auth-body-bg">
    <div class="home-btn d-none d-sm-block">
        <a href="https://www.smaperintis2.sch.id/"><i class="mdi mdi-home-variant h2 text-white"></i></a>
    </div>
    <div>
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-4">
                    <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                        <div class="w-100">
                            <div class="row justify-content-center">
                                <div class="col-lg-9">
                                    <div>
                                        <div class="text-center">
                                            <div>
                                                <a href="https://www.smaperintis2.sch.id/" class="logo">
                                                    <img src="{{ asset('images/logo.png') }}" height="100" alt="logo">
                                                </a>
                                            </div>
                                            @stack('page')
                                        </div>

                                        <!-- page content -->
                                        {{ $slot }}
                                        <!-- end page content -->

                                        <div class="mt-5 text-center">
                                            {{ date('Y') }}© PPDB SMA Perintis 2 Bandar Lampung</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="authentication-bg">
                        <div class="bg-overlay"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @livewireScripts
</body>

</html>
