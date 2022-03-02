<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    @yield('css')
    <link href="/css/app.css" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ url('bossUI') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/summernote/summernote-bs4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/toastr/toastr.min.css">
    <script src="{{ asset('js/app.js') }}" deter></script>
    {{-- livewire --}}
    @livewireStyles
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('bossUI') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="index.html" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('boss.dashboard') }}" class="nav-link">Dash board</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    @livewire('chat-bar')
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    @livewire('notification-bar')
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="get" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ url('bossUI') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('/storage/' . config('chatify.user_avatar.folder') . '/' . Auth::user()->avatar) }}"
                            class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                        <li class="nav-header">DASHBOARD</li>
                        <li class="nav-item">
                            <a href="{{ route('boss.dashboard') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'dashboard'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-clipboard"></i>
                                <p>
                                    Dashboard
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">ĐIỀU HÀNH</li>
                        <li class="nav-item">
                            <a href="{{ route('boss.schedule.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'schedule.'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>
                                    Công việc
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.schedule_detail.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'schedule_detail'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-truck-loading"></i>
                                <p>
                                    Chuyến
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-header">TIN NHẮN</li>
                        <li class="nav-item">
                            <a href="{{ route('chatify') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'chatify'),
                            ])>
                                <i class="nav-icon fas fa-messages"></i>
                                <p>
                                    Hộp tin nhắn
                                </p>
                            </a>
                        </li> --}}
                        <li class="nav-header">GIÁM SÁT</li>
                        <li class="nav-item">
                            <a href="{{ route('boss.tracking') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), '.tracking'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-map-marker-alt"></i>
                                <p>
                                    Giám sát xe
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ FILES</li>
                        <li class="nav-item">
                            <a href="{{ route('boss.file') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), '.file'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-folder-open"></i>
                                <p>
                                    Files manager
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">THÔNG TIN CHUNG</li>
                        <li class="nav-item">
                            <a href="{{ route('boss.truck.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'truck'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-truck-moving"></i>
                                <p>
                                    Xe
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.partner.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'partner'),
                                // 'active' => Route::currentRouteName() == 'boss.partner.create',
                                // 'active' => Route::currentRouteName() == 'boss.partner.edit',
                            ])>
                                <i class=" nav-icon fas fa-handshake"></i>
                                <p>
                                    Đối tác
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.cost_group.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'cost_group'),
                                // 'active' => Route::currentRouteName() == 'boss.partner.create',
                                // 'active' => Route::currentRouteName() == 'boss.partner.edit',
                            ])>
                                <i class="nav-icon fas fa-dollar-sign"></i>
                                <p>
                                    Chi phí
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.category.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'category'),
                                // 'active' => Route::currentRouteName() == 'boss.partner.create',
                                // 'active' => Route::currentRouteName() == 'boss.partner.edit',
                            ])>
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Hàng hóa
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.order.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'order'),
                                // 'active' => Route::currentRouteName() == 'boss.partner.create',
                                // 'active' => Route::currentRouteName() == 'boss.partner.edit',
                            ])>
                                <i class="nav-icon fas fa-dolly-flatbed"></i>
                                <p>
                                    Đơn hàng
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('boss.driver.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), 'driver'),
                                // 'active' => Route::currentRouteName() == 'boss.partner.create',
                                // 'active' => Route::currentRouteName() == 'boss.partner.edit',
                            ])>
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Tài xế
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Layout Options
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">6</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Top Navigation + Sidebar</p
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/boxed.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Boxed</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Sidebar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Sidebar <small>+ Custom Area</small></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-topnav.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Navbar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/fixed-footer.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Fixed Footer</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Collapsed Sidebar</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            @yield('breadcrumb')
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')



                    <!-- /.row (main row) -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        {{-- All notification Modal --}}
        <div class="modal fade" id="notificationModal" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">TẤT CẢ THÔNG BÁO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 300x; overflow: auto">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Danh sách thông báo</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                @livewire('all-notification-modal')
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ url('bossUI') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('bossUI') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{-- <script src="/js/app.js"></script> --}}
    <!-- Bootstrap 4 -->
    <script src="{{ url('bossUI') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- InputMask -->
    <script src="{{ url('bossUI') }}/plugins/moment/moment.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('bossUI') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ url('bossUI') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('bossUI') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('bossUI') }}/plugins/dropzone/min/dropzone.min.js"></script>
    {{-- sweetAlert --}}
    <script src="{{ url('bossUI') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    {{-- Toastr --}}
    <script src="{{ url('bossUI') }}/plugins/toastr/toastr.min.js"></script>
    {{-- <script src="{{ url('bossUI') }}/dist/js/adminlte.js"></script> --}}

    {{-- Echo listening to event --}}
    <script>
        Echo.private('App.Models.User.' + {{ Auth::user()->id }})
            .notification((notification) => {
                //console.log(notification.type);
                Livewire.emit('newNotificationCreated', notification);
                // $(document).Toasts('create', {
                //     class: 'bg-success',
                //     title: 'Toast Title',
                //     subtitle: 'Subtitle',
                //     body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
                // })
                toastr.warning('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.')
                //alert(notification);
            });
        Echo.channel('chatBoxApp')
            .listen('TruckMoved', (e) => {
                //console.log('oki');
                console.log(e);
            });
    </script>
    {{-- livewire --}}
    @livewireScripts

    @yield('js')
</body>

</html>
