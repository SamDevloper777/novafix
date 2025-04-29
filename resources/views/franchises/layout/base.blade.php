<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('Assets/faviconn.png') }}" type="image/x-icon">
    <title>@yield('title') </title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">


    @livewireStyles


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @php
            $recept = Auth::guard('receptioner')->id();
            $NewCountReq = App\Models\Request::where('technician_id', NULL)->where('reciptionist_id',$recept)->get()->count();
            $dateFilter = App\Models\Request::where('reciptionist_id',$recept)->get()->count();
            $ConformCountReq = App\Models\Request::where('reciptionist_id',$recept)->where('status', 1)->get()->count();
            $RejectedCountReq = App\Models\Request::where('reciptionist_id',$recept)->where('status', 3)->get()->count();
            $WorkdoneCountReq = App\Models\Request::where('reciptionist_id',$recept)->where('status', 4)->get()->count();
            $DeliveredCountReq = App\Models\Request::where('reciptionist_id',$recept)->where('status', 5)->get()->count();
            $PendingCountReq = App\Models\Request::where('reciptionist_id',$recept)->where('status', 0)->get()->count();
            $allReq = App\Models\Request::where('reciptionist_id',$recept)->get()->count();
        @endphp

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="/admin" class="nav-link">Home</a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('franchise.messages.req') }}" class="nav-link">Messages {{messageCounting()}}</a>
                </li> --}}
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
             
                <!-- Notifications Dropdown Menu -->
                <a class="nav-link" href="{{ route('franchise.messages.req') }}">
                    <i class="far fa-envelope"></i>
                    <span class="badge badge-warning navbar-badge">{{messageCounting()}}</span>
                </a>
               
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('franchise.panel') }}" class="brand-link">
                {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8"> --}}
                <span class="brand-text font-weight-light">Novafix Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">


                <div class="form-inline">
                    <form action="{{ route('franchise.request.globalSearch') }}" method="GET">
                        <div class="input-group">
                            <input class="form-control form-control-sidebar" type="search" name="search"
                                placeholder="Search">
                            <div class="input-group-append">
                                <button class="btn btn-sidebar" type="submit">
                                    <i class="fas fa-search fa-fw"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{ route('franchise.panel') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.newRequest.manage') }}" class="nav-link">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    New Request
                                    <span class="right badge badge-danger">{{ $NewCountReq }}</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Service Request</li>

                        <li class="nav-item">
                            <a href="{{ route('franchise.request.manageRequest') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.confirmed.req') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Confirmed</p>
                                <span class="badge badge-info right">{{ $ConformCountReq }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.pending.req') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> pending</p>
                                <span class="badge badge-info right">{{ $PendingCountReq }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.rejected.req') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Rejected</p>
                                <span class="badge badge-info right">{{ $RejectedCountReq }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.workDone.req') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Work Done</p>
                                <span class="badge badge-info right">{{ $WorkdoneCountReq }}</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.delivered.req') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p> Delivered</p>
                                <span class="badge badge-info right">{{ $DeliveredCountReq }}</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daily Reports</p>
                            </a>
                        </li> -->
                        <li class="nav-header">Staffs</li>

                        <li class="nav-item">
                            <a href="{{ route('franchise.staff.manage') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage Staff</p>
                                {{-- <P class='ml-4'>{{$staffs->count()}}</P> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('receptioner.showAllreceptioner') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Manage receptioner</p>
                                {{-- <P class='ml-4'>{{$staffs->count()}}</P> --}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.staff.create') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('receptioner.add') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Receptioner</p>
                            </a>
                        </li>

                        <li class="nav-header">Accounts</li>
                        <li class="nav-item">
                            <a href="{{ route('franchise.logout') }}" class="nav-link">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                <p class="text">Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">

            @section('content')
            @show
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            ©
            <script type="text/JavaScript">
                var theDate=new Date() 
                                        document.write(theDate.getFullYear()) 
                                    </script> All rights reserved. Developer team - <a
                href="https://github.com/aditya-shekhar773">Aditya Sekhar</a> - <a
                href="https://github.com/md-wasik-alam">Wasik Alam</a> and <a
                href="https://github.com/LazyDeveloperr">intkhab Ahmad</a>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    @livewireScripts

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
        </script>
    <!-- AdminLTE for demo purposes -->
    {{--
    <script src="{{ asset(" dist/js/demo.js") }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->

    <script type="text/javascript">
        var chart_data = @json(WeeklyCount());
        var sale_data = @json(MonthlyCount())
    </script>
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <script>
        var msg = '{{ Session::get('alert') }}';
        var exist = '{{ Session::has('alert') }}';
        if (exist) {
            alert(msg);
        }
    </script>


</body>

</html>