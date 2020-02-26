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

        <h3 class="box-title">Histórico de Órdenes de Servicio Ejecutadas</h3>

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
                    <th class="centro">Fecha Orden</th>
                    <th class="centro">Observación</th>
                    <th class="centro">Estado Orden</th>
                </tr>
            </thead>
            <tbody>
				@foreach($historico as $historial)
	          <tr style="text-align:center;">
                <td>{{ $historial->name }}{{ $historial->USR_APELLIDOS }}</td>
                <td>{{ $historial->USR_TELEFONO }}</td>
                <td>{{ $historial->USR_DIRECCION }}</td>   
                <td>{{ $historial->ORD_FECHAORDEN }}</td>   
                <td>{{ $historial->ORD_DESCRIPCION }}</td>   
                <td>{{ $historial->LOO_DESCRIPCION }}</td>   
	              <td class="centro">
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