@extends('recept.layout.index')

@section('title', 'Editar Empleado')

@section('contenido')
<style>
    #form {
        height: 500px;
    }

    @media only screen and (max-width: 768px) {
        #form {
            height: 680px;
            background-color: rgb(0, 162, 224);
        }
    }
</style>
<br>
<div class="col-lg-12">
    <div id="form" class="card card-body table-responsive p-0">

        <center>
            <div class="col-sm-4 text-center"><br>
                <img class="rounded-circle" src="{{asset('storage'.'/'.$id_folio->imagen)}}" alt="" width="75px" height="75px">
            </div>
        </center>


        <form method="POST" action="{{url('empleados/'.$id_folio->folio)}}" enctype="multipart/form-data" class="table table-head-fixed text-nowrap text-white" style="background-color: rgb(0, 162, 224);">
            {{-- token --}}
            @csrf
            {{ method_field('PUT') }}

            <div class="card-body card-block">


                <div class="form-group">
                    <label for="folio" class=" form-control-label">Folio es inremplazable</label>
                    <input type="text" name="folio" disabled="" value="{{$id_folio->folio}}" placeholder="Folio" class="form-control">
                </div>


                <div class="form-group">
                    <label for="nombre" class=" form-control-label">Nombre</label>
                    <input type="text" id="vat" name="nombre" value="{{$id_folio->nombre}}" placeholder="Nombre" class="form-control">
                </div>

                <div class="form-group">
                    <label for="apellido_p" class=" form-control-label">Apellido_p</label>
                    <input type="text" id="street" name="apellido_p" value="{{$id_folio->apellido_p}}" placeholder="Apellido_p" class="form-control">
                </div>

                <div class="form-group">
                    <label for="apellido_m" class=" form-control-label">Apellido_m</label>
                    <input type="text" id="street" name="apellido_m" value="{{$id_folio->apellido_m}}" placeholder="Apellido_m" class="form-control">
                </div>


                <div class="form-group">
                    <label for="telefono" class=" form-control-label">Telefono</label>
                    <input type="number" name="telefono" value="{{$id_folio->telefono}}" id="city" placeholder="Telefono" maxlength="10" class="form-control">
                </div>


                <div class="mb-3">
                    <label for="fotografia" class="form-label">Fotografia</label>
                    <input class="form-control" name="imagen" value="{{$id_folio->imagen}}" type="file" id="formFileMultiple" multiple>
                </div>

                <div class="form-group">
                    <label for="country" class=" form-control-label">Seleciona el puesto a asignar <tt>"El empleado es del area de: {{$id_folio->puestos->puesto}}" </tt></label>


                    <select name="id_puesto" class="form-control">
                        @foreach ($puestos as $puesto)
                        <option value="{{$puesto->id_puesto}}">{{$puesto->puesto}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="apellido_m" class=" form-control-label">Nip</label>
                    <input type="text" id="street" name="password" placeholder="Nip" class="form-control">
                </div>
                @error('mensajePassword') <div class="alert alert-danger">{{$message}}</div> @enderror
            </div>

            <div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-warning btn-md text-white">
                        Guardar
                    </button>


                    <a href="{{route('empleados')}}" class="btn btn-danger btn-md">
                        Cancelar
                    </a>
                </div>

            </div><br>


        </form>
    </div>
</div>
@endsection