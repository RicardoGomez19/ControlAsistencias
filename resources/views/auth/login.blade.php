<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">

  <title>Login</title>

  <!-- boostrap-->
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
  <!--external css-->
  <!-- font icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
  <link rel="shortcut icon" href="images/impulso.ico" type="image/x-icon" class="rounded-circle">
  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet" />
  <link href="css/style_login.css" rel="stylesheet">
  {{-- fontst-icons --}}
  <link rel="stylesheet" href="{{asset('css/fontawesome-free/css/all.min.css')}}">

</head>

<body class="body">

  <div class="container">

    {{-- action y metdo que ejecutara --}}
    <form id="form" class="login-form" action="{{route('login')}}" method="post">
      {{-- token  --}}
      @csrf
      <div class="login-wrap">
        <p class="text-center" id="admin">Login</p>
        <img id="img" class="rounded-circle" src="{{asset('images/impulso.jpg')}}" alt="logo">
        <div class="input-group" id="input">
          <span class="input-group-addon"><i class="fas fa-user fa-2x"></i></span>
          <input type="text" class="form-control" placeholder="Username" autofocus name="username">

        </div>
        {!! $errors->first('username', '<span class="help-block">:message</span>')!!}
        <div class="input-group" id="input">
          <span class="input-group-addon"><i class="fas fa-lock fa-2x"></i></span>
          <input type="password" class="form-control" placeholder="Password" name="password" required>

        </div>
        {!! $errors->first('password', '<span class="help-block" required>:message</span>')!!}
        <button id="boton" type="submit" class="btn btn-info btn-flat m-b-30 m-t-30" style="justify-content: center;">Acceder</button>

      </div>

      {!! $errors->first('Credenciales', '<div class="alert alert-danger">:message</div>')!!}


    </form>
    <br><br><br><br>
    <div class="text-center">
      <div class="credits text-white">
        Copyright Impulso-Like ® 2023
      </div>
    </div>
  </div>

  <!-- JavaScript Bundle with Popper -->


</body>

</html>