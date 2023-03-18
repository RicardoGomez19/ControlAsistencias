@extends('recept.layout.index')
<title>Empleados</title>

@section('contenido')
<div class="card-header">

</div>
<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5 class="text-center" v-if="headerText">Empleados
                </h5>
            </div>

            <!-- tabla de la pagina -->
            <div class="table-responsive">
                <!--   input para la busqueda -->

                <form method="POST" action="{{route('empleados/buscar')}}">
                    {{ csrf_field() }}
                    <div id="form-empleado" class="input-group col-lg-10">

                        <input type="text" class="form-control" placeholder="Ingrese el nombre" name="buscar" required>

                        <button class="btn btn-secondary" type="submit" id="button-addon2">Buscar</button>

                        <a href="{{route('empleados')}}" class="btn btn-warning btn-md text-white" id="sync"><i class="fas fa-sync"></i> Act</a>
                        <a href="{{route('empleado/create')}}" id="new" class="btn btn-info btn-md"><i class="fas fa-plus"></i> new</a>
                    </div>
                </form>
                @if(isset($mensaje))
                <div class="alert alert-danger">{{ $mensaje }}</div>
                @endif


                <br>

                <div id="tabla-empleado" class="card-body table-responsive p-0">
                    <table class="table text-nowrap">
                        <thead style="background-color: rgb(0, 162, 224);" class="text-white">
                            <tr>
                                <th>Folio</th>
                                <th>Fotografia</th>
                                <th>Nombre</th>
                                <th>Apellido_p</th>
                                <th>Apellido_m</th>
                                <th>Telefono</th>
                                <th>Puesto</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados as $empleado)
                            <tr>
                                <td class="serial">{{$empleado->folio}}</td>
                                <td class="avatar">
                                    <div class="round-img">
                                        <a href="{{url('empleado/'.$empleado->folio.'/edit')}}"><img class="rounded-circle" alt="" width="35px" height="35px" src="{{asset('storage'.'/'.$empleado->imagen)}}" alt=""></a>
                                    </div>
                                </td>
                                <td> {{$empleado->nombre}}</td>
                                <td> <span>{{$empleado->apellido_p}}</span> </td>
                                <td> <span>{{$empleado->apellido_m}}</span> </td>
                                <td><span>{{$empleado->telefono}}</span></td>
                                <td>{{$empleado->puestos->puesto}}</td>

                                <td>
                                    <form method="POST" action="{{url('empleados').'/'.$empleado->folio}}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete')}}
                                        {{-- <span class="badge badge-complete">Complete</span> --}}
                                        <a class="btn btn-info" href="{{url('empleado/'.$empleado->folio.'/edit')}}"><i class="fas fa-edit"></i></a>

                                        <button id="eliminar" type="submit" class="btn btn-danger" onclick="return confirm('Decea eliminar al empleado?');"><i class="fas fa-trash"></i></button>

                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection


@push('js')
<script type="text/javascript" src="{{asset('js/site.min.js')}}"></script>

@endpush
<link rel="stylesheet" href="css/tablas.css">