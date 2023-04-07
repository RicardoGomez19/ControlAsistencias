@extends('recept.layout.index')

@section('title', 'Nuevo Empleado')

@section('contenido')

<br>
<div class="col-lg-12">
    <div id="form" class="card card-body table-responsive p-0">
        <form method="POST" action="{{ route('empleados') }}" enctype="multipart/form-data" class="table table-head-fixed text-nowrap text-white">
            {{-- token --}}
            @csrf

            <div class="col-sm-12" style="background-color: rgb(0, 162, 224); width: 100%; height: 60px;">
                <h3 class="text-center">Agregue nuevo empleado</h3>
            </div>
            <!-- chat inicio -->

            <!-- chta -->
            <div class="card-body card-block">


                <div class="form-group">
                    <label for="folio" class=" form-control-label">Folio</label>
                    <input type="number" name="folio" id="company" placeholder="Escriba un Folio" class="form-control" value="{{ old('folio') }}">
                </div>

                <!-- algo mio -->
                {!! $errors->first('algo', '<div class="alert alert-danger">:message</div>') !!}
                @error('folio') <div class="alert alert-danger">{{$message}}</div> @enderror

                <!-- fin algo mio -->
                <div class="form-group">
                    <label for="nombre" class=" form-control-label">Nombres</label>
                    <input type="text" id="vat" maxlength="30" name="nombre" placeholder="Escriba los Nombres" class="form-control" value="{{ old('nombre') }}">
                </div>
                @error('nombre') <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group">
                    <label for="apellido_p" class=" form-control-label">Apellido_p</label>
                    <input type="text" id="street" maxlength="30" name="apellido_p" placeholder="Escriba un Apellido_p" class="form-control">
                </div>
                @error('apellido_p') <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group">
                    <label for="apellido_m" class=" form-control-label">Apellido_m</label>
                    <input type="text" id="street" maxlength="30" name="apellido_m" placeholder="Escriba un Apellido_m" class="form-control">
                </div>
                @error('apellido_m') <div class="alert alert-danger">{{$message}}</div> @enderror
                <div class="form-group">
                    <label for="telefono" class=" form-control-label">Telefono</label>
                    <input type="number" name="telefono" max="9999999999" id="city" placeholder="Escriba un número de Telefono" maxlength="10" class="form-control">
                </div>
                @error('telefono') <div class="alert alert-danger">{{$message}}</div> @enderror

                <div class="mb-3">
                    <label for="fotografia" class="form-label">Fotografia</label>
                    <input class="form-control" placeholder="Seleccione una imagen" name="imagen" type="file" id="formFileMultiple" multiple>
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
                    <label for="contraseña" class=" form-control-label">Contraseña</label>
                    <input type="text" id="street" name="password" placeholder="Escriba una Contraseña" class="form-control">
                </div>
                @error('password') <div class="alert alert-danger">{{$message}}</div> @enderror
            </div>

            <div>


                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-secondary btn-md text-white">
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
<link rel="stylesheet" href="{{asset('css/tablas.css')}}">