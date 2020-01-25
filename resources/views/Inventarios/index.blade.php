@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Inventario<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Inventario </li>
    </ol>
</section>

<!-- Ventana modal editar Articulo-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Artículo</h4>
        </div>
        <div class="modal-body">
          <div id="consultarInventario"></div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
</div>

@if(Session::has('message'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-success alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> - {{Session::get('message')}}
      </div>
    </div>
  </div>  
@endif

<div class="row">

	<div class="col-xs-12">
    <a href="{{ url('articulo_create/'.$id.'/'.$idInm) }}" id="btn_agregarInmueble" class="btn btn-danger btn-flat">Ingresar Artículos</a>
		<a href="{{ url('inmueble_index/'.$id) }}" id="btn_agregarInmueble" class="btn btn-primary btn-flat">Regresar</a>
	</div><br><br>

	  <div class="col-md-12">
	    <div class="box box-danger">

	      <div class="box-header with-border">
	        <h3 class="box-title">Buscar Artículos <span class="badge bg-teal"  data-toggle="tooltip" title="buscar un Articulo en especifico o listarlos todos para agregar a su inventario" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
	      </div>

	      <div class="box-body">
	        <div class="col-md-6">
	        	<h4>Nombre</h4>
	        	<input type="text" class="form-control" id="nombre_articulo" placeholder="Nombre del Articulo">
	        </div>
	        <div class="col-md-6">
	        	<h4>&nbsp;</h4>
	        	<button class="btn btn-primary btn-flat btn_buscarArt1">Buscar</button>
	        </div>
	      </div>

	      <div class="box-footer">
	        
	      </div>
	           
	    </div>
	  </div>

  	<div id="insert_BuscArticulos1" data-idInm="{{ $idInm }}" data-idProp="{{ $id }}"></div>

    <div class="col-xs-12">
      <div class="box box-danger">
      
          <div class="box-header with-border">
            <h3 class="box-title">Listar todos los articulos para agregar las cantidades <button class="btn btn-primary btn-flat btn_buscarArt1">Listar</button></h3>
          </div>
    
          <div class="box-body">
            <div class="table-responsive" id="insert_inventario">
  	    			<table class="table table-bordered table-hover table-striped" data-ruta="../../estado_articuloInv">
  	    				<thead>
  	    					<tr>
  	    						<th>Nombre Artículo</th>
  	    						<th class="centro">Cantidad</th>
                    <th class="centro">Estado</th>
                    <th class="centro">Acciones</th>
  	    					</tr>
  	    				</thead>
  	    				<tbody>
  	    				@foreach($inventarios as $inventario)
  	    					@if($inventario->INV_ESTADO)
  	    					<tr data-id="{{ $inventario->INV_IDINVENTARIO }}">
  	    					@else
  	    					<tr data-id="{{ $inventario->INV_IDINVENTARIO }}" class="changeEstate">
  	    					@endif
  	    						<td>{{$inventario->ART_NOMBRE}}</td>
  	    						<td class="centro">{{$inventario->INV_CANTIDAD}}</td>
                    <td class="centro">
                      <input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($inventario->INV_ESTADO == 1) checked @endif >
                    </td>
                    <td class="centro">
                      <a class="btn btn-danger btn-sm btn_modal2" data-idInm="{{ $idInm }}" data-idProp="{{ $id }}" data-id="{{ $inventario->INV_IDINVENTARIO }}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
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