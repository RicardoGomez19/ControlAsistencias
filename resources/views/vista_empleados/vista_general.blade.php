@extends('layout')

@section('contenido')
<div>
<div class="site-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7 text-center">
        <div class="site-section-title">
          
          <h2>Eres empleado de la empresa?</h2>
        </div>
        <p>Tendras la capacidad de llevar a cabo la validacion de su asistencia, asignando su indenficador de empleado "FOLIO".</p>
      </div>

    </div>


    <div class="row">

      <div class="col-lg-6 col-lg-4">
        <span class="service text-center">
          <img style="width: 80px; height: 90px;" src="{{asset('images/empresa.png')}}">
          <!-- <span class="icon flaticon-house"></span> -->
          <h2 class="service-heading">Ingresar al trabajo</h2>
          <!--        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p> -->
          <p><button class=" btn boton text-white" style="background-color: rgb(0, 162, 224);" data-bs-toggle="modal" data-bs-target="#exampleModal">Entrada <i class="fas fa-sign-in-alt"></i></button>
            <a class="btn btn-danger boton" href="{{url('EmpleRegisters')}}">Salida <i class="fas fa-sign-out-alt"></i></a>
          </p>
        </span>
      </div>

      <div class="col-lg-6 col-lg-4">
        <a href="#" class="service text-center">
          <img style="width: 80px; height: 90px;" src="{{asset('images/tarjeta-de-identificacion.png')}}">
          <!--  <span class="icon flaticon-sold"></span> -->
          <h2 class="service-heading">Consultar datos</h2>
          <!--              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p> -->
          <p><button class="btn boton text-white" style="background-color: rgb(0, 162, 224);" data-bs-toggle="modal" data-bs-target="#empleados">Buscar <i class="fas fa-search"></i></button>
        </a>
      </div>

      <!--      <div class="col-md-6 col-lg-4">
        <a href="#" class="service text-center">
            <img style="width: 80px; height: 90px;" src="{{asset('images/charla.png')}}">
          <span class="icon flaticon-camera"></span>
          <h2 class="service-heading">Asuntos u opinioness</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Incidunt iure qui natus perspiciatis ex odio molestia.</p>
          <p><button class="btn btn-info boton"><i class="fas fa-comment-dots"></i></button></p>
        </a>
      </div> -->

    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="mensajes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal" aria-label="Close">X</button>
      </div> -->

      <div class="modal-body">
        <center>

          <div class="container">
            <img src="{{asset('images/icons/comprobado.png')}}" width="100px" height="100px">
            <!-- @if(session()->has('bienvenida'))
            <div class="alert alert-success">{{session('bienvenida')}}</div>
            @endif -->
            <br>
            <div>
              <h3><strong>Bienvenido a la empresa</strong></h3>
            </div>
          </div>

        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">OK</button>

      </div>
    </div>
  </div>
</div>

@endsection