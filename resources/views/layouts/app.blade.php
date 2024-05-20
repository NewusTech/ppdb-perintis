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
    <!-- Alpien Js-->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    @livewireStyles
</head>

<body data-sidebar="light">
    <!-- Loader -->
    <div id="preloader">
        <div id="status" class="w-100 h-100">
            <div class="spinner w-100 h-100">
                {{-- <i class="ri-loader-line spin-icon"></i> --}}
                <div class="d-flex flex-column justify-content-center align-items-center h-100">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="width: 7rem">
                    <h4 class="mt-3 text-center "><strong>SMA Perintis 2 <br>Bandar Lampung</strong></h4>
                </div>
            </div>
        </div>
    </div>

    {{-- <body data-sidebar="dark"> --}}
    <!-- START layout-wrapper -->
    <div id="layout-wrapper">
        @include('livewire.layouts.topbar')
        @include('livewire.layouts.sidebar')

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0">{{ $title ?? '' }}</h4>
                                <!-- start breadcrumb -->
                                <div class="page-title-right">
                                    <ol class="m-0 breadcrumb">
                                        <li class="breadcrumb-item active">{{ $titleBreadcrumb ?? '' }}</li>
                                        <li class="breadcrumb-item">{{ $title ?? '' }}</li>
                                    </ol>
                                </div>
                                <!-- end breadcrumb -->
                            </div>
                        </div>
                    </div>

                    <!-- page content -->
                    {{ $slot }}
                    <!-- end page content -->
                </div>
                <!-- container-fluid -->
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © SMA Perintis 2 Bandar Lampung.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Develop with <i class="mdi mdi-heart text-danger"></i> by <a
                                    href="http://newus.id/">Newus Teknologi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    {{-- @include('livewire.layouts.right-sidebar') --}}

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <div class="rightbar-overlay"></div>

    <!-- javascript -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metismenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/node-waves.min.js') }}"></script>

    @stack('scripts')
    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    @livewireScripts
</body>

</html>
