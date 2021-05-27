<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>ERP System | {{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- jQuery -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Select2 -->
    <link
        rel="stylesheet"
        href="/assets/plugins/select2/css/select2.min.css"
    />
    <link
        rel="stylesheet"
        href="/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"
    />
    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="/assets/plugins/fontawesome-free/css/all.min.css"
    />
    <!-- Ionicons -->
    <link
        rel="stylesheet"
        href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"
    />
    <!-- Tempusdominus Bbootstrap 4 -->
    <link
        rel="stylesheet"
        href="/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"
    />
    <!-- iCheck -->
    <link
        rel="stylesheet"
        href="/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css"
    />
    <!-- JQVMap -->
    <link rel="stylesheet" href="/assets/plugins/jqvmap/jqvmap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css" />

    <!-- overlayScrollbars -->
    <link
        rel="stylesheet"
        href="/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"
    />
    <!-- Daterange picker -->
    <link
        rel="stylesheet"
        href="/assets/plugins/daterangepicker/daterangepicker.css"
    />
    <!-- summernote -->
    <link
        rel="stylesheet"
        href="/assets/plugins/summernote/summernote-bs4.css"
    />
    <!-- Google Font: Source Sans Pro -->
    <link
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700"
        rel="stylesheet"
    />
    <!-- DataTables -->
    <link
        rel="stylesheet"
        href="/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
        rel="stylesheet"
        href="/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Custom style -->
    <link rel="stylesheet" href="/assets/css/style.css" />


    <script>
        function flash_message(message, type){
            if(type == "success"){
                message = '<div class="alert alert-success text-center" role="alert" style="display: none">'+ message +'</div>';
            } else if (type == "info"){
                message = '<div class="alert alert-info text-center" role="alert" style="display: none">'+ message +'</div>';
            } else {
                message = '<div class="alert alert-danger text-center" role="alert" style="display: none">'+ message +'</div>';
            }
            $("#flash_message").html(message);
            $("#flash_message").find('.alert').slideToggle().delay(5000).slideToggle();
        }
        $(document).ready(function() {
            @if(Session::has('message'))
            flash_message('{{ Session::get("message") }}', '{{ Session::get("class") }}');
            @endif
        });
    </script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div
    id="flash_message"
    style="position: fixed; z-index: 9999; width: 100%; text-align: center;text-decoration-color: white"

></div>

<div class="wrapper">
    <!-- Navbar -->
    <nav
        class="main-header navbar navbar-expand navbar-white navbar-light"
    >
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link"
                    data-widget="pushmenu"
                    href="#"
                    role="button"
                ><i class="fas fa-bars"></i
                    ></a>
            </li>
            <li class="nav-item">
                <h2 class="m-0 text-dark">{{ $title ?? '' }}</h2>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <img height="90px" src="" style="margin-left: 15px">

        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel py-1 d-flex">
                <div class="image">
                </div>
                @php
                $settings = \App\Models\Setting::all();
                $company_name = $settings[0]->title;
                @endphp
                <div class="info">
                    <a href="#" class="d-block">{{ucfirst(Auth::user()->name)}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
        @include('layouts.left_bar')
        <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <strong
        >Copyright &copy; 2020
            <a href="#">Dubai ERP System</a>.</strong
        >
        All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

@include ('layouts.footer_js')

@yield('page_script')

</body>
</html>
