<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    {{-- additional css --}}
    <link href="/css/app.css" rel="stylesheet">
    @yield('css')
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
    {{-- AlpineJS --}}
    {{-- <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
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
                    <a href="{{ route('staff.index') }}" class="nav-link">Trang chủ</a>
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
                    {{-- <a class="nav-link" href="{{ route('chatify') }}">
                        <i class="far fa-comments"></i>
                        @if (\App\Models\ChMessage::where('seen', 0)->where('to_id', Auth::user()->id)->count() > 0)
                            <span
                                class="badge badge-danger navbar-badge">{{ \App\Models\ChMessage::where('seen', 0)->where('to_id', Auth::user()->id)->count() }}</span>
                        @endif
                    </a> --}}
                    @livewire('chat-bar')
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    @livewire('notification-bar')
                    {{-- <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        @if (Auth::user()->unreadNotifications->count() > 0)
                            <span class="badge badge-warning navbar-badge">
                                {{ Auth::user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        @foreach (Auth::user()->unreadNotifications as $unreadNotification)
                            @php
                                $notifiedUser = \App\Models\User::find($unreadNotification->data['userId']);
                            @endphp
                            @if ($notifiedUser)
                                <a href="#" class="dropdown-item">
                                    <!-- Message Start -->
                                    <div class="media">
                                        <img src="{{ asset('/storage/' . config('chatify.user_avatar.folder') . '/' . $notifiedUser->avatar) }}"
                                            alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                        <div class="media-body">
                                            <h3 class="dropdown-item-title font-weight-bold">
                                                {{ $unreadNotification->data['name'] }}
                                                <span class="float-right text-sm text-danger"><i
                                                        class="fas fa-star"></i></span>
                                            </h3>
                                            @if ($unreadNotification->type == 'App\Notifications\NewUserNotification')
                                                <p class="text-sm">Vừa đăng ký tài khoản với email
                                                    <span
                                                        class="font-weight-bold">{{ $unreadNotification->data['email'] }}</span>
                                                </p>
                                            @elseif ($unreadNotification->type == 'App\Notifications\completeSchedule')
                                                <p class="text-sm">Vừa hoàn thành công việc giao ngày ngày
                                                    <span
                                                        class="font-weight-bold">{{ Carbon\Carbon::parse($unreadNotification->data['schedule']['date'])->format('d-m-Y') }}</span>
                                                </p>
                                            @elseif ($unreadNotification->type == 'App\Notifications\createSchedule')
                                                <p class="text-sm">Bạn vừa được
                                                    <span class="font-weight-bold">
                                                        {{ $unreadNotification->data['name'] }} </span> giao một
                                                    công việc vào
                                                    ngày
                                                    <span
                                                        class="font-weight-bold">{{ Carbon\Carbon::parse($unreadNotification->data['schedule']['date'])->format('d-m-Y') }}</span>
                                                </p>
                                            @else
                                                <p class="text-sm"> Đã có lỗi sảy ra</p>
                                            @endif
                                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                                {{ \Carbon\Carbon::createFromTimestamp(strtotime($unreadNotification->created_at))->diffForHumans(\Carbon\Carbon::now()) }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Message End -->
                                </a>
                            @endif
                            <div class="dropdown-divider"></div>
                        @endforeach
                        <a href="#" class="dropdown-item dropdown-footer">See All Notification</a>
                    </div> --}}
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
                        <li class="nav-item">
                            <a href="{{ route('staff.index') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), '.index'),
                            ])>
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Home
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CÔNG VIỆC</li>
                        <li class="nav-item">
                            <a href="{{ route('staff.schedules') }}" @class([
                                'nav-link',
                                'active' => strpos(Route::currentRouteName(), '.schedules'),
                                // 'active' => Route::currentRouteName() == 'boss.truck.create',
                                // 'active' => Route::currentRouteName() == 'boss.truck.edit',
                            ])>
                                <i class="nav-icon fas fa-network-wired"></i>
                                <p>
                                    Tất cả công việc
                                    {{-- <span class="right badge badge-danger">New</span> --}}
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">QUẢN LÝ FILES</li>
                        <li class="nav-item">
                            <a href="{{ route('staff.file') }}" @class([
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
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div @class([
            'content-wrapper',
            'kanban' => strpos(Route::currentRouteName(), '.index'),
        ])>
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                            <button id="location-button">Click</button>
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
            <section @class([
                'content',
                'pb-3' => strpos(Route::currentRouteName(), '.index'),
            ])>
                <div class="container-fluid h-100 ">
                    <!-- Small boxes (Stat box) -->
                    @yield('content')
                    <!-- /.row (main row) -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
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
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
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
        @livewire('broadcast-position')
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
    <script src="/js/app.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('bossUI') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{ url('bossUI') }}/plugins/chart.js/Chart.min.js"></script>
    {{-- <!-- Sparkline -->
    <script src="{{ url('bossUI') }}/plugins/sparklines/sparkline.js"></script> --}}
    {{-- <!-- JQVMap -->
    <script src="{{ url('bossUI') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
    {{-- <!-- jQuery Knob Chart -->
    <script src="{{ url('bossUI') }}/plugins/jquery-knob/jquery.knob.min.js"></script> --}}
    <!-- daterangepicker -->
    <script src="{{ url('bossUI') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ url('bossUI') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="{{ url('bossUI') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ url('bossUI') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{ url('bossUI') }}/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('bossUI') }}/dist/js/demo.js"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ url('bossUI') }}/dist/js/pages/dashboard.js"></script> --}}


    {{-- GG map api --}}
    <script>
        options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0
        };

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        const successCallBack = function(position) {
            console.log(position);
            Livewire.emit('positionBroadCastes', position.coords.latitude, position.coords.longitude, position.coords
                .speed, position.timestamp);
        }
        $('#location-button').click(function() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(successCallBack, error, options);
            }
        });
        Echo.channel('chatBoxApp')
            .listen('AskForPositionInfo', (e) => {
                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(successCallBack, error, options);
                }
            });
        // let map;

        // function initMap() {
        //     map = new google.maps.Map(document.getElementById("map"), {
        //         center: {
        //             lat: -34.397,
        //             lng: 150.644
        //         },
        //         zoom: 8,
        //     });

        // $.get("http://maps.googleapis.com/maps/api/geocode/json?latlng=" + position.coords
        //     .latitude + "," + position.coords.longitude + "&sensor=false",
        //     function(data) {
        //         console.log(data);
        //     })
        // var img = new Image();
        // img.src = "https://maps.googleapis.com/maps/api/staticmap?center=" + position.coords
        //     .latitude + "," + position.coords.longitude + "&zoom=13&size=800x400&sensor=false";
        // $('#output').html(img);
    </script>
    {{-- Echo --}}
    <script>
        Echo.private('App.Models.User.' + {{ Auth::user()->id }})
            .notification((notification) => {
                //console.log(notification.type);
                Livewire.emit('newNotificationCreated', notification);
            });
    </script>
    @livewireScripts
    @yield('js')
</body>

</html>
