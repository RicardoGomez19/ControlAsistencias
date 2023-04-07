@extends('recept.layout.index')
@section('title', 'Salarios')
@section('contenido')
<div id="salarios_api">
    <br>
    <!--     <p>@{{prueba}}</p> -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">


                <!-- tabla de la pagina -->
                <div class="table-responsive">
                    <!--   input para la busqueda -->
                    <div class="card-body">
                        <div class=" text-center">
                            <h3 class="h2 mt-3">Salarios</h3>
                            <div class="card-header d-flex justify-content-between align-items-center col-12 mx-auto mt-3">
                                <div class="col-6 d-flex justify-content-start px-3">
                                    <input type="text" class="form-control" placeholder="Buscar el salario" v-model="buscar">
                                </div>
                                <div class="col-4 d-flex justify-content-end">
                                    <button type="button" class="btn btn-info btn-md" @click="ActivarModal()"><i class="fas fa-plus"></i> New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabla-puestos" class="card-body table-responsive p-0">
                        <table class="tabla text-nowrap">
                            <thead thead style="background-color: rgb(0, 162, 224);" class="text-white">
                                <tr>
                                    <th>ID</th>
                                    <th>Salario día</th>
                                    <th>Puesto</th>
                                    <th>Año</th>
                                    <th>Mes</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha final</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(salario, i) in paginar" :key="i">

                                    <td hidden="">@{{salario.id}}</td>
                                    <td>@{{i + 1}}</td>
                                    <td>@{{salario.valor}}</td>
                                    <td>@{{salario.puestos.puesto}}</td>
                                    <td>@{{salario.anio}}</td>
                                    <td>@{{salario.mes}}</td>
                                    <td>@{{salario.fecha_inicio}}</td>
                                    <td>@{{salario.fecha_fin}}</td>
                                    <td>

                                        <button class="btn btn-info" @click="salario_edit(salario.id)"><i class="fas fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger" @click="salario_delete(salario.id)"><i class="fas fa-trash"></i></button>

                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--inicio paginacion-->
    <div class="w-33">
        <div class="text-center">
            <button type="button" id="btn" class="btn" @click="anteriorPagina">
                << </button>
                    <button type="button" id="btn" class="btn" v-for="num in numeroDePaginas" :key="num" @click="seccionarPagina(num)">@{{num}}</button>
                    <button type="button" id="btn" class="btn" @click="siguientePagina"> >> </button>
        </div>
    </div>
    <!--final paginacion-->
    <!-- Modal -->
    <div class="modal fade" id="ModalSalario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(0, 162, 224);">

                    <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==true">Agregando Salario</h5>
                    <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==false">Editando Salario</h5>

                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="valor" class=" form-control-label">Salario por día</label>
                        <input type="number" v-model="valor" name="salario" placeholder="Salario" class="form-control">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="mes" class=" form-control-label">Mes</label>
                        <input type="number" v-model="mes" name="mes" placeholder="Mes" class="form-control">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="anio" class=" form-control-label">Año</label>
                        <input type="number" v-model="anio" name="anio" placeholder="Año" class="form-control">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="fecha_I" class=" form-control-label">Fecha inicio</label>
                        <input type="date" v-model="fecha_inicio" name="fecha_inicio" placeholder="Fecha-inicio" class="form-control">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="fecha_F" class=" form-control-label">Fecha finalizar</label>
                        <input type="date" v-model="fecha_fin" name="fecha_fin" placeholder="Fecha-final" class="form-control">
                    </div>
                </div>

                <div class="modal-body">
                    <label class="">Selecciona un Puesto</label>
                    <select class="form-control" v-model="id_puesto">
                        <option v-for="puesto in puestos" v-bind:value="puesto.id_puesto"> @{{puesto.puesto}} </option>
                    </select>
                </div>
                <!-- algo mio -->
                {!! $errors->first('salario', '<div class="alert alert-danger">:message</div>') !!}
                @error('id_puesto') <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-info" v-if="banderaModal==true" @click="salario_store()">Guardar</button>
                    <button type="button" class="btn btn-info" v-if="banderaModal==false" @click="salario_update()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection


@push('js')
<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
<script type="text/javascript" src="{{asset('js/apis/apiSalario.js')}}"></script>

<script src="{{asset('js/sweetalert.min.js')}}"></script>


@endpush
<link rel="stylesheet" href="css/tablas.css">
<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->