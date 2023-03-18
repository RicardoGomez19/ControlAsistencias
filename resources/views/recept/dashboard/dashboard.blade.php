@extends('recept.layout.index')

@section('title','Dashboard')

@section('contenido')
{{-- <h5>Bienvenido al sistema : {{ Auth::user()->name }}</h5> --}}
<br>
<div class="badges" style="margin-left: 10px; margin-right: 10px;">
    <div class="row">

        <div class="col-lg-4">

            <div class="card">
                <img class="card-img-top" src="{{asset('images/empleados.jpg')}}" width="70%" height="70%">
                <div class="card-body text-center">
                    
                    <a class="btn btn-primary" href="{{route('empleados')}}">Consultar empleados</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <img class="card-img-top" src="{{asset('images/puestos.png')}}" width="70%" height="70%">
                <div class="card-body text-center">
                    <a class="btn btn-primary" href="{{route('puestos')}}">Consultar puestos</a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="card">
                <img class="card-img-top" width="70%" height="70%" src="{{asset('images/history.png')}}">
                <div class="card-body text-center">
                    
                    <a class="btn btn-primary" href="{{route('historial')}}">Consultar control de personal</a>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection