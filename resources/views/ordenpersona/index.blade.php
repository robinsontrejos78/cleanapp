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
    <div class="box box-danger">

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
                    <th class="centro">Propiedad</th>
                    <th class="centro">Dirección</th>
                    <th class="centro">Fecha de la orden</th>
                    <!-- <th class="centro">Costo</th> -->
                    <!-- <th class="centro">Huespedes</th> -->
                    <th class="centro">Descripción</th>
                    <th class="centro">Acciones</th>
                </tr>
            </thead>
            <tbody>
				@foreach($ordenes as $orden)
	          <tr style="text-align:center;">
                <td>{{ $orden->ORD_USR_CLI }}</td>
	              <td>{{ $orden->PRO_NOMBRE }}</td>
	              <td>{{ $orden->INM_DIRECCION }}</td>
	              <td>{{ date_format(new DateTime($orden->ORD_FECHAORDEN), 'Y-m-d / h:i') }}</td>
                <!-- <td>{{ $orden->ORD_COSTO }}</td>    -->
              <!--   <td>{{ $orden->ORD_HUESPEDES }}</td>    -->
                <td>{{ $orden->ORD_DESCRIPCION }}</td>   
	              <td class="centro">
                  <a href="comenzarOrden/{{$orden->ORD_IDORDEN}}" class="btn btn-success btn-xs">Comenzar</a>
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