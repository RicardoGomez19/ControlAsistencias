@extends('recept.layout.index')
@section('title','Dashboard')

@section('contenido')
{{-- <h5>Bienvenido al sistema : {{ Auth::user()->name }}</h5> --}}
<br>
<div class="badges" style="margin-left: 30px; margin-right: 30px;">
    <div class="row ">

        <div class="row mb-4">

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Bienvenido</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{Auth::user()->name}}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fas fa-user"></i></span>
                                    <span>Administrador</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-4x text-black"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Empleados</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Total de Empleados:</span><br>
                                    <h4 class="text-center">{{$totalEmpleados}}</h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="card-img-top" src="{{asset('images/empleados1.png')}}" width="68px" height="60px">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('empleados')}}">Ver empleados</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Historial</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Total de Historiales: </span><br>
                                    <h4 class="text-center">{{ $totalHistoriales }}</h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="card-img-top" width="70px" height="80px" src="{{asset('images/history1.png')}}">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('historial')}}">Ver historial</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Puestos</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Total de Puestos:</span><br>
                                    <h4 class="text-center">{{$totalPuestos}}</h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="card-img-top" src="{{asset('images/puestos1.png')}}" width="70px" height="90px">
                            </div>

                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('puestos')}}">Ver puestos</a>
                </div>

            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Salarios</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Total de Salarios:</span><br>
                                    <h4 class="text-center">{{$totalSalarios}}</h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="card-img-top" width="70px" height="90px" src="{{asset('images/dinero2.png')}}">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('salarios')}}">Ver salarios</a>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Usuarios</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                                    <span>Total de usuarios:</span><br>
                                    <h4 class="text-center">{{$totalUsuarios}}</h4>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img class="card-img-top" src="{{asset('images/usuarios1.jpg')}}" width="70px" height="90px">
                            </div>

                        </div>
                    </div>
                    <a class="btn btn-primary" href="{{route('usuarios')}}">Ver usuarios</a>
                </div>

            </div>
            <!-- <div class="col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="{{asset('images/empleados.jpg')}}" width="70%" height="70%">
                    <div class="card-body text-center">

                        <a class="btn btn-primary" href="{{route('empleados')}}">Consultar empleados</a>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-lg-4">

                <div class="card">
                    <img class="card-img-top" src="{{asset('images/puestos.png')}}" width="70%" height="70%">
                    <div class="card-body text-center">
                        <a class="btn btn-primary" href="{{route('puestos')}}">Consultar puestos</a>
                    </div>
                </div>
            </div> -->

            <!-- <div class="col-lg-4">

                <div class="card">
                    <img class="card-img-top" width="70%" height="70%" src="{{asset('images/history.png')}}">
                    <div class="card-body text-center">

                        <a class="btn btn-primary" href="{{route('historial')}}">Consultar control de personal</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>

</div>
@endsection