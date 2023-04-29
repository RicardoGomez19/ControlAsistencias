@extends('recept.layout.index')
@section('title', 'Usuarios')

@section('contenido')
<div id="usuarios_api">
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
                            <h3 class="h2 mt-3">Usuarios</h3>
                            <div class="card-header d-flex justify-content-between align-items-center col-12 mx-auto mt-3">
                                <div class="col-6 d-flex justify-content-start px-3">
                                    <input type="text" class="form-control" placeholder="Buscar usuario" v-model="buscar">
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
                                    <th>Nombre Completo</th>
                                    <th>Email</th>
                                    <th>Usuario</th>
                                    <th hidden="">password</th>
                                    <th>status</th>

                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(usuario, i) in paginar" :key="i">

                                    <td hidden="">@{{usuario.id}}</td>
                                    <td>@{{i + 1}}</td>
                                    <td>@{{usuario.name}}</td>
                                    <td>@{{usuario.email}}</td>
                                    <td>@{{usuario.username}}</td>
                                    <td hidden="">@{{usuario.password}}</td>
                                    <td class="text-white">
                                        <span :style="{ backgroundColor: usuario ? 'green' : 'red', borderRadius: '4px', padding: '2px 6px' }">
                                            @{{usuario ? "Activo" : "Inactivo" }}
                                        </span>
                                    </td>

                                    <td>

                                        <button class="btn btn-info" @click="usuario_edit(usuario.id)"><i class="fas fa-edit"></i></button>

                                        <button type="button" class="btn btn-danger" @click="usuario_delete(usuario.id)"><i class="fas fa-trash"></i></button>

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
    <div class="modal fade" id="ModalUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(0, 162, 224);">

                    <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==true">Agregando Usuario</h5>
                    <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==false">Editando Usuario</h5>

                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="name" class=" form-control-label">Nombre completo</label>
                        <input type="text" v-model="name" name="name" placeholder="Nombre Completo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="username" class=" form-control-label">Usuario</label>
                        <input type="text" v-model="username" name="username" placeholder="Usuario" class="form-control" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="email" class=" form-control-label">Correo</label>
                        <input type="email" v-model="email" name="email" placeholder="Correo" class="form-control" required>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="">
                        <label for="password" class=" form-control-label">Password</label>
                        <input type="password" v-model="password" name="Password" placeholder="Password" class="form-control" required>
                    </div>
                </div>

                <!-- algo mio -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-info" v-if="banderaModal==true" @click="usuario_store()">Guardar</button>
                    <button type="button" class="btn btn-info" v-if="banderaModal==false" @click="usuario_update()">Actualizar</button>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection


@push('js')
<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
<script type="text/javascript" src="{{asset('js/apis/apiUsuario.js')}}"></script>

<script src="{{asset('js/sweetalert.min.js')}}"></script>


@endpush
<link rel="stylesheet" href="css/tablas.css">
<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->