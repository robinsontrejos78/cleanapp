@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<!--  -->

@if(Session::has('message'))
    <br><br>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        {{Session::get('message')}}
    </div>
@endif

<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Lista de Ordenes de Servicio</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoEmp">
            <thead>
                <tr>
                    <th class="centro">Cliente</th>
                    <th class="centro">Teléfono</th>
                    <th class="centro">Dirección</th>
                    <th class="centro">Fecha de la orden</th>
                    <th class="centro">Horas</th>
                    <th class="centro">Descripción del plan</th>
                    <th class="centro">Acciones</th>
                </tr>
            </thead>
            <tbody>
				@foreach($ordenes as $orden)
	          <tr style="text-align:center;">
                <td>{{ $orden->name }} {{ $orden->USR_APELLIDOS }}</td>
                <td>{{ $orden->USR_TELEFONO }}</td>
	              <td>{{ $orden->ORD_INM_IDINMUEBLE }}</td>
	              <td>{{ date_format(new DateTime($orden->ORD_INICIOORDEN), 'Y-m-d  h:i') }}</td>
                <td>
                  <?php 
                    $start_date = new DateTime($orden->ORD_INICIOORDEN);
                    $since_start = $start_date->diff(new DateTime($orden->ORD_FINORDEN));
                    echo $since_start->h.' H ';
                  ?>                          
                </td>
                <td>{{ $orden->ORD_DESCRIPCION }}</td>   
	              <td class="centro">
                  <a href="comenzarOrden/{{$orden->ORD_IDORDEN}}" class="btn btn-success btn-xs">Terminar</a>
                </td>
	          </tr>
				@endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

@endsection