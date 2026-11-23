<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="dark" data-bs-theme="light">

<head>


    <meta charset="utf-8" />
    <title>@yield('title', 'My Account') | Healix HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Healix HMS Patient Portal" name="description" />
    <meta content="Healix HMS" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ site_setting('favicon_path') ? storage_url(site_setting('favicon_path')) : asset('backend/assets/images/favicon.ico') }}">



    <!-- App css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/custom-responsive.css') }}" rel="stylesheet" type="text/css" />

    @stack('styles')

</head>

<body>

    @include('partials.backend.topbar')

    @include('partials.patient.sidebar')

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box d-md-flex justify-content-md-between align-items-center">
                            <h4 class="page-title">@yield('page-title', 'My Account')</h4>
                            <div class="">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('patient.dashboard') }}">Healix HMS</a>
                                    </li><!--end nav-item-->
                                    <li class="breadcrumb-item active">@yield('page-title', 'My Account')</li>
                                </ol>
                            </div>
                        </div><!--end page-title-box-->
                    </div><!--end col-->
                </div><!--end row-->

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')

            </div><!--end container-fluid-->
        </div>
        <!--end page-content-->

        @include('partials.backend.footer')

    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    @stack('scripts')

</body>
<!--end body-->

</html>
