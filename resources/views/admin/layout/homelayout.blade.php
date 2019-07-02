<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <link href="{{ config('social.admin-css') }}" rel="stylesheet">
    <link href="{{ config('social.all-min-css') }}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{ config('social.sb-admin') }}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <a class="navbar-brand js-scroll-trigger" href="{{ route('admins.return_home') }}">
                @if (isset($admin))
                    @if (!empty($admin->avatar))
                        <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                        src="{{ config('social.admin-img') . $admin->avatar }}" alt="avatar">
                    @else
                        <img class="img-fluid img-profile rounded-circle mx-auto mb-2"
                        src="{{ config('social.student-default-img') }}" alt="avatar">
                    @endif
                @endif
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-address-card font-size-20"></i>
                    <span>{{ __('lang.check_information') }}</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('admins.return_profile') }}">{{ __('lang.check_information') }}</a>
                        <a class="collapse-item" href="#">{{ __('lang.update_information') }}</a>
                    </div>
                </div>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav">
                        @yield('link')
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ $admin->full_name }}</span>
                                @if (!empty($admin->avatar))
                                    <img class="img-profile rounded-circle"
                                    src="{{ config('social.admin-img') . $admin->avatar }}" alt="avatar">
                                @else
                                    <img class="img-profile rounded-circle"
                                    src="{{ config('social.student-default-img') }}" alt="avatar">
                                @endif
                                
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('admins.return_profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('lang.check_information') }}
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('lang.change_password') }}
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('admins.do_logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('lang.logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>

    <script src="{{ config('social.jquery') }}"></script>
    <script src="{{ config('social.bootstrap-bundle') }}"></script>

    <script src="{{ config('social.admin-js') }}"></script>

</body>

</html>
