@extends('recept.layout.index')

@section('title', 'Nuevo Empleado')

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
        <form method="POST" action="{{ route('empleados') }}" enctype="multipart/form-data" class="table table-head-fixed text-nowrap text-white" style="background-color: rgb(0, 162, 224);">
            {{-- token --}}
            @csrf

            <div>
                <h3 class="text-center">Agregue nuevo empleado</h3>
            </div>
            <!-- chat inicio -->

            <!-- chta -->
            <div class="card-body card-block">


                <div class="form-group">
                    <label for="folio" class=" form-control-label">Folio</label>
                    <input type="number" name="folio" id="company" placeholder="Folio" class="form-control" value="{{ old('folio') }}">
                </div>

                <!-- algo mio -->
                {!! $errors->first('algo', '<div class="alert alert-danger">:message</div>') !!}
                @error('folio') <div class="alert alert-danger">{{$message}}</div> @enderror

                <!-- fin algo mio -->
                <div class="form-group">
                    <label for="nombre" class=" form-control-label">Nombres</label>
                    <input type="text" id="vat" name="nombre" placeholder="Nombres" class="form-control" value="{{ old('nombre') }}">
                </div>
                @error('nombre') <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group">
                    <label for="apellido_p" class=" form-control-label">Apellido_p</label>
                    <input type="text" id="street" name="apellido_p" placeholder="Apellido_p" class="form-control">
                </div>

                <div class="form-group">
                    <label for="apellido_m" class=" form-control-label">Apellido_m</label>
                    <input type="text" id="street" name="apellido_m" placeholder="Apellido_m" class="form-control">
                </div>


                <div class="form-group">
                    <label for="telefono" class=" form-control-label">Telefono</label>
                    <input type="number" name="telefono" id="city" placeholder="Telefono" maxlength="10" class="form-control">
                </div>


                <div class="mb-3">
                    <label for="fotografia" class="form-label">Fotografia</label>
                    <input class="form-control" name="imagen" type="file" id="formFileMultiple" multiple>
                </div>
                @error('imagen') <div class="alert alert-danger">{{$message}}</div> @enderror


                <div class="form-group">
                    <label for="country" class=" form-control-label">Seleciona el puesto a asignar</label>

                    <select name="id_puesto" id="" class="form-control">
                        @foreach ($puestos as $puesto)
                        <option value="{{$puesto->id_puesto}}">{{$puesto->puesto}}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="apellido_m" class=" form-control-label">Nip</label>
                    <input type="text" id="street" name="password" placeholder="Nip" class="form-control">
                </div>
                {!! $errors->first('algo', '<div class="alert alert-danger">:message</div>') !!}
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
<link rel="stylesheet" href="css/tablas.css">