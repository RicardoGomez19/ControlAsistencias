<div class="col-lg-12">

  <div class="container">
    <div class="card-tools">
      <div class="col-12">
        <form method="post" action="{{url('historial/pdf')}}" target="_blank">
          {{ csrf_field() }}

          <div class="card-tools text-center">
            <div class="input-group input-group-sm" style="justify-content:center;">
              <div class="input-group col-lg-4 ">
                <input type="date" class="form-control" name="fecha1" placeholder="Fecha">

              </div>
              <span>A</span>
              <div class="input-group col-lg-4 ">
                <input type="date" class="form-control" name="fecha2" placeholder="Fecha">

              </div>
              <span>O</span>
              <div class="input-group col-lg-4" id="escriFolio">
                <input type="text" class="form-control" name="folio" placeholder="escriba el folio">

              </div>
              <!--   <div class="input-group-append"> -->
              <button style="margin: 5px; margin-top: 14px;" type="submit" class="btn btn-danger"><i class="fas fa-file-pdf"></i></button>
              <!--   </div> -->
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>

  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Historial de registro personal</h3>

        <div class="card-tools">
          <div class="input-group col-12">
            <input type="text" name="table_search" class="form-control float-right" wire:model.debounce.500ms="buscar" placeholder="Escriba el nombre">
          </div>
        </div>

      </div>
    </div>
    <!-- /.card-header -->
    <div id="tabla-historial" class="card-body table-responsive p-0">
      <table class="tabla text-nowrap">
        <thead style="background-color: rgb(0, 162, 224);" class="text-white">
          <tr>
            <!--  <th> id</th> -->
            <th>Folio</th>
            <th>Nombres</th>
            <th>apellidos</th>
            <th>Fecha_Entrada</th>
            <th>Hra_Entrada</th>
            <th>Hra_Salida</th>
            <th>Hrs de trabajo</th>
            <th>Pagos</th>
          </tr>
        </thead>
        <tbody>
          @foreach($history as $his)
          <tr>
            <!--    <td>{{$his->id_historial}}</td> -->
            <td>{{$his->folio}}</td>
            <td>{{$his->empleados->nombre}}</td>
            <td>{{$his->empleados->apellido_p}}</td>
            <td>{{$his->fecha_entrada}}</td>
            <td><span class="tag tag-success">{{$his->hora_entrada}}</span></td>
            <!--        <td>{{Carbon\Carbon::parse($his->hora_salida)->format('H:i a')}}</td> -->

            <td>
              @if($his->hora_salida=='')

              <p class="property-title letra"><a><span class="offer-type bg-success" style="border-radius: 4px;">En curso</span></a></p>
              @else
              <p class="property-title letra"><a><span class="offer-type bg-danger" style="border-radius: 4px;">{{$his->hora_salida}}</span></a></p>
              @endif
            </td>

            <!-- <td>{{Carbon\Carbon::parse($his->totalhr)->format('H:i')}} Hrs</td> -->

            <td>
              @if($his->totalhr=='')

              <p class="property-title letra"><a><span class="offer-type bg-success" style="border-radius: 4px;">En curso</span></a></p>
              @else
              <p class="property-title letra"><a><span class="offer-type bg-danger" style="border-radius: 4px;">{{$his->totalhr}} Hrs</span></a></p>
              @endif
            </td>
            @if($his->sueldo=='')
            <td>

              <p>${{$his->id}}</p>


            </td>
            @endif


          </tr>

          @endforeach

        </tbody>


        <tr>
          <th style="background-color: rgb(244, 246, 249); border:rgb(244, 246, 249)"></th>
          <!-- <th colspan="7" style="text-align: right; background-color: white;">TOTAL:</th>
          <td> MXN</td> -->
        </tr>

      </table>

    </div>

    <!-- /.card-body -->

  </div>

</div>
    @if ($history->lastPage() > 1)
    <div class="d-flex justify-content-center mt-1">
      <ul class="pagination">
        @php
        $current_page = $history->currentPage();
        $last_page = $history->lastPage();
        $total_items = $history->total();
        $show_pages = 10;
        $half_total_links = floor($show_pages / 2);
        $from = $current_page - $half_total_links;
        $to = $current_page + $half_total_links;

        if ($current_page < $half_total_links) { $to +=$half_total_links - $current_page; } if ($last_page - $current_page < $half_total_links) { $from -=$half_total_links - ($last_page - $current_page) - 1; } $from=$from < 1 ? 1 : $from; $to=$to> $last_page ? $last_page : $to;
          @endphp
          @if($current_page > 1)
          <li class="page-item">
            <a class="page-link" href="{{ $history->previousPageUrl() }}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          @endif
          @for ($i = $from; $i <= $to; $i++) <li class="page-item {{ ($current_page == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $history->url($i) }}">{{ $i }}</a>
            </li>
            @endfor
            @if($current_page < $last_page) <li class="page-item">
              <a class="page-link" href="{{ $history->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
              </a>
              </li>
              @endif
      </ul>
    </div>
    @endif
 