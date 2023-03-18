@extends('recept.layout.index')
@section('title', 'Puestos')
@section('contenido')
<div id="puestos_api">
  <br>
  <!--     <p>@{{prueba}}</p> -->
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">


        <!-- tabla de la pagina -->
        <div class="table-responsive">
          <!--   input para la busqueda -->
          <div class="col-6">
            <br>
            <input type="text" class="form-control" placeholder="Buscar puesto" v-model="buscar">
          </div>
          <div class="input-group col-10" style="justify-content: right; margin:0px 0px 10px 0px;">
            <button type="button" class="btn btn-info" @click="ActivarModal()"><i class="fas fa-plus"></i> New</button>
          </div>

          <div id="tabla-puestos" class="card-body table-responsive p-0">
            <table class="table text-nowrap">
              <thead thead style="background-color: rgb(0, 162, 224);" class="text-white">
                <tr>

                  <th>ID</th>
                  <th>Puesto</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="puesto in filtrarPuesto">
                  <td hidden=""></td>
                  <td>@{{puesto.id_puesto}}</td>
                  <td> <span>@{{puesto.puesto}}</span> </td>

                  <td>

                    <button class="btn btn-info" @click="puesto_edit(puesto.id_puesto)"><i class="fas fa-edit"></i></button>

                    <button type="button" class="btn btn-danger" @click="puesto_delete(puesto.id_puesto)"><i class="fas fa-trash"></i></button>

                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="ModalPuesto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color: rgb(0, 162, 224);">

          <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==true">Agregando Puesto</h5>
          <h5 class="modal-title text-white" id="exampleModalLabel" v-if="banderaModal==false">Editando Puesto</h5>

          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nombre" class=" form-control-label">Nombre del puesto</label>
            <input type="text" v-model="puesto" id="vat" name="Puesto" placeholder="Puesto" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-info" v-if="banderaModal==true" @click="puesto_store()">Guardar</button>
          <button type="button" class="btn btn-info" v-if="banderaModal==false" @click="puesto_update()">Actualizar</button>
        </div>
      </div>
    </div>
  </div>


</div>


@endsection


@push('js')
<script type="text/javascript" src="{{asset('js/vue-resource.js')}}"></script>
<script type="text/javascript" src="{{asset('js/apis/apiPuesto.js')}}"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endpush
<link rel="stylesheet" href="css/tablas.css">
<!-- se define este elemento inpunt con el fin de consumir la api en cualquier ruta o en cualquier equipo -->
<input type="hidden" name="route" value="{{url('/')}}">
<!-- y dentro del archivo scrip se define el codigo correspondiente para localizar o leer de que la aplicacion 
podria ser consumida o ejecutada desde cualquier medio -->