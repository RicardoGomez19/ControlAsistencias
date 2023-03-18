<div>
  <!-- Modal -->
  <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    {{-- <div class="col-8"> --}}
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registra tu entrada</h5>
          <button type="button" wire:click="cerraModal()" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          <div class="card card-warning">
            <div class="card-body">
              @if (session()->has('MensajeExiste'))
              <div class="alert alert-danger">{{ session('MensajeExiste') }}</div>
              @else
              <form role="form">
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Folio</label>
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Escriba su folio..." aria-label="Recipient's username" aria-describedby="button-addon2" wire:model="folio">

                        <button wire:click="ObtenerDat()" class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" wire:model="nombre" placeholder="Su nombre es: " disabled="">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Fecha Entrada</label>
                      <input type="" class="form-control" wire:model="dia" disabled="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Apellido P</label>
                      <input type="text" class="form-control" wire:model="apellido_p" placeholder="Su apellidos es: " disabled="">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Hora entrada</label>
                      <input type="" class="form-control" wire:model="hr_entrada" disabled="">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Apellido M</label>
                      <input type="text" class="form-control" wire:model="apellido_m" placeholder="Su apellidos es: " disabled="">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group" hidden="">
                      <label>Hora salida</label>
                      <input type="time" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Puesto</label>
                      <input type="text" class="form-control" wire:model="puesto" placeholder="Su puesto es: " disabled="">
                    </div>
                  </div>
                </div>

                <!-- para habilitar el mensaje de session -->
                @if(session()->has('MensajeD'))
                <div class="alert alert-warning">{{session('MensajeD')}}</div>
                @endif





                <!-- para habilitar el mensaje de session -->
                @if(session()->has('Existe'))
                <div class="alert alert-warning">{{session('Existe')}}</div>
                @endif



              </form>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" wire:click="cerraModal()" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" wire:click="createHistorial()" {{$hayError ? 'disabled' : ''}}>Confirmar</button>
        </div>
      </div>
      @endif
    </div>
    {{-- </div> --}}
  </div>


</div>