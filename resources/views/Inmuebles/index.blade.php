@extends('layouts.app')
@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Inmuebles<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Inmuebles </li>
    </ol>
</section>

<!-- Ventana modal inmueble-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información de Inmueble</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-hover table-striped">
              <tbody id="consultarInmueble">
                  
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

@if(Session::has('message'))
    <br><br>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check"></i> Alerta!</h4>
        {{Session::get('message')}}
    </div>
@endif

<div class="row">

	<div class="col-xs-12">
    <a href="{{ url('inmueble_create/'.$id) }}" id="btn_agregarInmueble" class="btn btn-danger btn-flat">Agregar Inmueble</a>
		<a href="{{ url('propiedad') }}" id="btn_agregarInmueble" class="btn btn-primary btn-flat">Regresar</a>
	</div><br><br>
	
  	<div class="col-xs-12">
  		<div class="box box-danger">
			
  	    	<div class="box-header with-border">
  	    		<h3 class="box-title">Inmueble</h3>
  	    	</div>
		
  	    	<div class="box-body">
  	    	<div class="table-responsive">
  	    	  	<table class="table table-bordered table-hover table-striped" data-ruta="../estadoInmueble">
  	    	  		<thead>
  	    	  			<tr>
  	    	  				<th>Propiedad</th>
                    <th>Tipo</th>
                    <th>Dirección</th>
  	    	  				<th class="centro">Estado</th>
  	    	  				<th class="centro">Acciones</th>
  	    	  			</tr>
  	    	  		</thead>
  	    	  		<tbody>
  	    	  		@foreach($inmuebles as $inmueble)
  	    	  		@if($inmueble->INM_ESTADO)
  	    	  			<tr data-id="{{ $inmueble->INM_IDINMUEBLE }}">
  	    	  		@else
  	    	  			<tr data-id="{{  $inmueble->INM_IDINMUEBLE }}" class="changeEstate">
  	    	  		@endif
  	    	  				<td>{{ $inmueble->PRO_NOMBRE }}</td>
                    <td>{{ $inmueble->LOO_DESCRIPCION }}</td>
                    <td>{{ $inmueble->INM_DIRECCION }}</td>
  	    	  				<td class="centro">
  	    	  					<input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($inmueble->INM_ESTADO == 1) checked @endif >
  	    	  				</td>
  	    	  				<td class="centro">
  	    	  					<a class="btn btn-default btn-sm btn_modal1" data-table="Inmueble" data-show="../show" data-id="{{ $inmueble->INM_IDINMUEBLE }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Consultar"><span class="glyphicon glyphicon-search"></span></a>

  	    	  					<a class="btn btn-primary btn-sm" href="../inmueble_edit/{{ $inmueble->INM_IDINMUEBLE }}/{{ $id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>

  	    	  					<a class="btn btn-info btn-sm" href="{{ url('articulo_index/'.$id.'/'.$inmueble->INM_IDINMUEBLE) }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Administrar Inventario"><span class="glyphicon glyphicon-briefcase"></span></a>
  	    	  				</td>
  	    	  			</tr>
  	    	  		@endforeach
  	    	  		</tbody>
  	    	  	</table>
  	    	</div>
  	    	</div>

  	  	</div>
  	</div>
</div>

@endsection

