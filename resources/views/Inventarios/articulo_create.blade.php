@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Inventario<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Inventario </li>
        <li class="active"> Crear Artículo </li>
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
          <div id="consultarArticulo"></div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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

@if(Session::has('message1'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-danger alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> - {{Session::get('message1')}}
      </div>
    </div>
  </div>  
@endif

<div class="row">
	
	<div class="col-xs-12">
		<a href="{{ url('articulo_index/'.$id.'/'.$idInm) }}" id="btn_agregarInmueble" class="btn btn-danger btn-flat">Regresar</a>
	</div><br><br>

	<div class="col-xs-12">
	  	<div class="box box-danger">
					
	  		<div class="box-header with-border">
	  			<h3 class="box-title">Crear Artículo</h3>
	  		</div>
		
	  	    <div class="box-body">
				<form action="{{ url('articulo_store/'.$id.'/'.$idInm) }}" action="POST" class='deshabilita'>
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="col-md-6">
						<h4>Nombre</h4>
						<input type="text" class="form-control" placeholder="Nombre Articulo" name="nombre">
					</div>
					<div class="col-md-6">
						<h4>&nbsp;</h4>
						<input type="submit" class="btn btn-primary btn-flat" value="Crear Articulo" name="">
						
					</div>

				</form>
	  	    </div>
	
	  	</div>
	</div>

	<div class="col-md-12">
	    <div class="box box-danger">

	      <div class="box-header with-border">
	        <h3 class="box-title">Buscar Artículos</h3>
	      </div>

	      <div class="box-body">
	        <div class="col-md-6">
	        	<h4>Nombre</h4>
	        	<input type="text" class="form-control" id="nombre_articulo" placeholder="Nombre del Articulo">
	        </div>
	        <div class="col-md-6">
	        	<h4>&nbsp;</h4>
	        	<button class="btn btn-primary btn-flat btn_buscarArt2">Buscar Artículos</button>
	        </div>
	      </div>

	      <div class="box-footer">
	        <div class="busqueda"></div>
	      </div>
	           
	    </div>
	  </div>

	<div class="col-xs-12">
	  	<div class="box box-danger">
					
	  		<div class="box-header with-border">
	  			<h3 class="box-title">Artículos</h3>
	  		</div>
		
	  	    <div class="box-body">
				<div class="table-responsive">
				<div id="insert_BuscArticulos2">
					<table class="table table-bordered table-hover table-striped" data-ruta="../../estado_articulo">
						<thead>
							<tr>
								<th>Nombre Artículo</th>
								<th class="centro">Estado</th>
								<th class="centro">Acciones</th>
							</tr>
						</thead>
						<tbody>
						@foreach($articulos as $articulo)
							@if($articulo->ART_ESTADO)
							<tr data-id="{{ $articulo->ART_IDARTICULO }}">
							@else
							<tr data-id="{{ $articulo->ART_IDARTICULO }}" class="changeEstate">
							@endif
								<td>{{$articulo->ART_NOMBRE}}</td>
								<td class="centro">
									<input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($articulo->ART_ESTADO == 1) checked @endif >
								</td>
								<td class="centro">
									<a class="btn btn-primary btn-sm btn_modal1" data-table="Articulo" data-show="../edit_" data-id="{{ $articulo->ART_IDARTICULO }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
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
</div>

@endsection