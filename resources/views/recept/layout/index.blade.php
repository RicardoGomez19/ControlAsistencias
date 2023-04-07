<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="shortcut icon" href="">
  <!--   framework vue -->
  <script type="text/javascript" src="{{asset('js/vue.js')}}"></script>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('css/AdminLTE/adminlte.min.css')}}">

  <link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">

  {{-- fontst-icons --}}
  <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">



  <!--     datepicker -->
  @stack('css')
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker.min.css')}}"> -->


  <!-- //se define el token para tener la capacidad de utilizar los metodos ´post, la cual debemos habilitar en el kernel el token. -->
  <!-- y se define el codigo correspondiente para pedir un toquen al servidor  -->

  <!-- token -->
  <meta name="token" id="token" value="{{ csrf_token() }}">
  <!-- despues en cada archivo javascript debemos definir los codigos correspondientes para leer el token -->

  @livewireStyles
</head>

<body class="hold-transition sidebar-mini" onload="mostrarSaludo()">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark text-white" style="background-color: rgb(0, 162, 224);">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link text-white" data-widget="pushmenu" href="" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{route('dashboard')}}" class="nav-link text-white">Dashboard</a>
        </li>
        <!--  <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <!--    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->




        <!-- 
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
         
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
           
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
           
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
      
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->






        <!-- Notifications Dropdown Menu -->


        <!--    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
 -->

        <!--  //session chats -->
        <!--   <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">  <i class="far fa-comments"></i></a>
      </li>
-->

        <li class="nav-item dropdown">
          <a class="nav-link text-white" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-md  text-center" style="background-color: rgb(0, 162, 224);">

            <div class="media">
              <div class="media-body">

                <form action="{{route('salir')}}" method="POST" style="margin: 2%;">
                  @csrf
                  <a class="text-white">{{Auth::user()->name}}
                    <button style="padding: auto;" class="btn btn-danger" type="submit"><i class="fas fa-sign-out-alt "></i> Cerrar sesión </button>
                  </a>
                </form>

              </div>
            </div>

          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->




    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-danger elevation-3">
      <!-- Brand Logo -->
      <a href="{{url('dashboard')}}" class="brand-link text-center" style="background-color: rgb(0, 162, 224);">
        <!-- <img src="{{asset('images/impulso.jpg')}}" class="nav-icon elevation-2 text-center" alt="User Image" width="22px" height="22px"> -->
        <span class="brand-text text-white">Control de asistencias</span>

      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content:center">
          <div class="image">
            <img src="{{asset('images/impulso.jpg')}}" class="img-circle elevation-2" alt="User Image" width="40px" height="40px">
          </div>
          <div class="info">
            <a class="d-block text-white">{{Auth::user()->name}}</a>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <br>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active text-white">
                <i class="nav-icon fa fa-bars"></i>
                <p>
                  Contenido
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" style="overflow-y: auto;">

                <li class="nav-item">
                  <a href="/dashboard" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                  </a>
                </li>

                <li class="nav-item">
                  <a href="/empleados" class="nav-link">
                    <i class="nav-icon fas fa-user-friends"></i>
                    <p>Empleados</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/puestos" class="nav-link">
                    <!-- <i class="far fa-circle nav-icon"></i> -->
                    <i class="nav-icon fas fa-toolbox"></i>
                    <p>Puestos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/salarios" class="nav-link">
                    <i class="nav-icon fa fa-money-bill"></i>
                    <p>Salarios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/historial" class="nav-link">
                    <i class="nav-icon fas fa-history"></i>
                    <p>Historial</p>
                  </a>
                </li>
              </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div>
        @yield('contenido')
      </div>
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Mensajes</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer text-black">
      <!-- To the right -->

      <!--     ///session hora actual saludo buenos dias -->

      <div class="float-right d-none d-sm-inline">

        <img name="tiempo" width="25px" height="25px">

        <tt id="txtsaludo"></tt>

        {{ Auth::user()->name }}
      </div>

      <!-- Default to the left -->
      <strong>Copyright Impulso-Like ® 2023</strong>

    </footer>
  </div>
  <!-- ./wrapper -->
  @stack('js')


  @livewireScripts


  <!-- jQuery -->
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('js/adminlte.min.js')}}"></script>

  <script src="{{asset('js/jsactive/active.js')}}"></script>

  <script src="{{asset('js/jsactive/date.js')}}"></script>
  <!-- Script para  ejecutar el pickerData -->
  <!-- <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script> -->
  
  <!-- <script type="text/javascript">
    $('.js-date').datepicker({
      format: "yyyy/mm/dd"
    });

    $('.js-date_o').datepicker({
      format: "yyyy/mm/dd"
    });
  </script> -->


</body>

</html>