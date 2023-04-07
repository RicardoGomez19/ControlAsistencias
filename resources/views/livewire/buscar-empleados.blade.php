<div class="col-lg-12">
    <div class="card">
        <div class="card-header">

            <div class="table-responsive">
                <div class="text-center">
                    <h3 class="h3 mt-3">Empleados</h3>
                    <div class="card-header d-flex justify-content-between align-items-center col-12 mx-auto mt-3">
                        <div class="col-6 d-flex justify-content-start px-3" width: 100%;>
                            <input type="text" name="table_search" class="form-control mr-2" wire:model.debounce.500ms="buscar" placeholder="Escriba el nombre del empleado">
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <a class=" text-white" href="{{ route('empleado/create') }}">
                                <button type="button" class="btn btn-info btn-md">
                                    <i class="fas fa-plus"></i> New
                                </button>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- /.card-header -->
                <div id="tabla-empleado" class="card-body table-responsive p-0">
                    <table class="tabla text-nowrap">
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
                                <td>{{$empleado->folio}}</td>
                                <td class="avatar">
                                    <div class="round-img">
                                        <a href="{{url('empleado/'.$empleado->folio.'/edit')}}"><img class="rounded-circle" alt="" width="30px" height="30px" src="{{asset('storage'.'/'.$empleado->imagen)}}" alt=""></a>
                                    </div>
                                </td>
                                <td> {{$empleado->nombre}}</td>
                                <td> {{$empleado->apellido_p}}</td>
                                <td> {{$empleado->apellido_m}}</td>
                                <td>{{$empleado->telefono}}</td>
                                <td>{{$empleado->puestos->puesto}}</td>

                                <td>
                                    <form method="POST" action="{{url('empleados').'/'.$empleado->folio}}">

                                        {{ csrf_field() }}
                                        {{ method_field('delete')}}
                                        <a class="btn btn-info btn-sm" href="{{url('empleado').'/'.$empleado->folio.'/edit'}}"><i class="fas fa-edit"></i></a>

                                        <!-- Agrega un botón que abra el modal de confirmación -->
                                        <button id="eliminar" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmarEliminacion{{$empleado->folio}}"><i class="fas fa-trash"></i></button>

                                        <!-- Modal de confirmación -->
                                        <div class="modal fade" id="confirmarEliminacion{{$empleado->folio}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-red" id="exampleModalLabel">Eliminar empleado</h4>
                                                        <button type="button" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h5> ¿Está seguro de eliminar a este empleado? </h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                                <!-- <td>
                                    <form method="POST" action="{{url('empleados').'/'.$empleado->folio}}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete')}}
                                        <a class="btn btn-info btn-sm" href="{{url('empleado').'/'.$empleado->folio.'/edit'}}"><i class="fas fa-edit"></i></a>

                                        <button id="eliminar" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Decea eliminar al empleado?');"><i class="fas fa-trash"></i></button>

                                    </form>

                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
    <!-- /.card-body -->
</div>
<div class="container table-responsive" style="text-align: center;">
    <div class="text-center" style="display: inline-block;">
        {{ $empleados->links('pagination::bootstrap-4') }}
    </div>
</div>