<!DOCTYPE html>
<html lang="en">

<head>
  <title>IMPULSO-LIKE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500">

  <link href="https://icons8.com">
  <link rel="stylesheet" href="homeland/css/bootstrap.min.css">
  <link rel="stylesheet" href="homeland/css/magnific-popup.css">
  <link rel="stylesheet" href="homeland/css/jquery-ui.css">
  <link rel="stylesheet" href="homeland/css/owl.carousel.min.css">
  <link rel="stylesheet" href="homeland/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="homeland/css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="homeland/css/mediaelementplayer.css">
  <link rel="stylesheet" href="homeland/css/animate.css">
  <link rel="stylesheet" href="homeland/fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="homeland/css/fl-bigmug-line.css">


  <link rel="shortcut icon" href="">


  {{-- fontst-icons --}}
  <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">


  <link rel="stylesheet" href="homeland/css/aos.css">

  <link rel="stylesheet" href="homeland/css/style.css">

  <link rel="stylesheet" href="{{asset('css/vistalayout.css')}}">

  @stack('style')
  @livewireStyles


</head>

<body>
  @livewire('create-historial')

  @livewire('dats-empleados')

  <div class="site-loader"></div>

  <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(0, 162, 224);">
    <div class="container-fluid text-white">
      <h1>IMPULSO-LIKE</h1>
      <a href=""> <img class="rounded-circle" src="{{asset('images/impulso.jpg')}}" alt="" width="50px" height="50px"></a>
    </div>
  </nav>

  @yield('contenido')

  @livewireScripts
  <script src="homeland/js/jquery-3.3.1.min.js"></script>
  <script src="homeland/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="homeland/js/jquery-ui.js"></script>
  <script src="homeland/js/popper.min.js"></script>
  <script src="homeland/js/bootstrap.min.js"></script>
  <script src="homeland/js/owl.carousel.min.js"></script>
  <script src="homeland/js/mediaelement-and-player.min.js"></script>
  <script src="homeland/js/jquery.stellar.min.js"></script>
  <script src="homeland/js/jquery.countdown.min.js"></script>
  <script src="homeland/js/jquery.magnific-popup.min.js"></script>
  <script src="homeland/js/bootstrap-datepicker.min.js"></script>
  <script src="homeland/js/aos.js"></script>

  <script src="homeland/js/main.js"></script>

  <script type="text/javascript" src="{{asset('js/bundle/bootstrap.bundle.min.js')}}"></script>

  @stack('js')

  <script src="{{asset('js/modales/modales.js')}}"></script>
  <!--   
script para ocultar el modal que viene de livwire -->



</body>

</html>