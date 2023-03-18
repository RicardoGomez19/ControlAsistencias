<div>

	@if(session()->has('exit'))
	<div class="alert alert-success">{{session('exit')}}</div>
	@endif

	<div class="row">
		@foreach($history as $his)
		<div class="col-md-6 col-lg-4" style="margin-top: 10px;">
			<span class="service ">
				<div class="card">
					<div class="p-4 property-body">
						<!-- <a href="#" class="property-favorite"><span class="icon-heart-o"></span></a> -->
						<p class="property-title letra" hidden=""><a>id: {{$his->id_historial}}</a></p>
						<p class="property-title letra" hidden=""><a>Folio: {{$his->folio}}</a></p>
						<p class="property-title letra"><a>Nombre: {{$his->empleados->nombre}}</a> </p>
						<p class="property-title letra"><a>Fecha entrada: {{$his->fecha_entrada}} </a> </p>
						<p class="property-title letra"><a>Hora entrada: {{$his->hora_entrada}} hrs</a> </p>
						@if($his->id_statu=='1')

						<p class="property-title letra"><a>Estado: <span class="offer-type bg-success" style="border-radius: 4px;">En curso</span></a></p>
						@else
						<p class="property-title letra"><a>Estado: <span class="offer-type bg-danger" style="border-radius: 4px;">Termino</span></a></p>
						@endif
						<br>
						<ul class="property-specs-wrap mb-3 mb-lg-0">

							<li>
								@if($his->id_statu=='1')
								<button class="btn btn-info letra" wire:click="ConfirmHrS({{$his->id_historial}})">Terminar</button>
								@else
								<p class="property-title letra"><a><span class="offer-type bg-danger" style="border-radius: 4px;">Ya salio de la empresa</span></a></p>
								@endif

							</li>
						</ul>

					</div>
				</div>
			</span>
		</div>
		@endforeach

	</div>

	<!-- Modal -->
	<div class="modal fade" wire:ignore.self id="salidas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		{{-- <div class="col-8"> --}}
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Confirmar tu salida</h5>
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">X</button>
				</div>
				<div class="modal-body">
					<div class="card card-warning">

						<div class="card-body">
							<form>
								<div class="mb-3">
									<label for="recipient-name" class="col-form-label">Folio:</label>
									<input type="text" name="folio" class="form-control" wire:model="folio" id="recipient-name" disabled="">
								</div>
								<div class="mb-3">
									<label for="text" class="col-form-label">Hora salida:</label>
									<!--   <input type="text" class="form-control" wire:model="hr_Salida"  disabled="" > -->
									<input type="text" class="form-control" name="" wire:model="hora_salida" disabled="">
								</div>
								<input type="text" name="" wire:model="totalhr" hidden="">

								<input type="text" wire:model="ids" name="" hidden="">
								<div class="mb-3">
									<label for="text" class="col-form-label">Password</label>
									<!--   <input type="text" class="form-control" wire:model="hr_Salida"  disabled="" > -->
									<input type="password" placeholder="Escriba su contraseña para terminar" class="form-control" id="password" name="" wire:model="password">
								</div>
								@if (session()->has('errorContra'))
								<div class="alert alert-danger">{{ session('errorContra') }}</div>
								@endif
							</form>
						</div>
						<!-- /.card-body -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-primary" wire:click="RegSalida()">Confirmar</button>
				</div>
			</div>
		</div>
		{{-- </div> --}}
	</div>


</div>

<style type="text/css">
	.letra {
		font-size: 18px;
		font-style: italic;
		font-family: 'PT Sans';
		font-weight: bold;
	}
</style>