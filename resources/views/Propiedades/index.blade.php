@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Propiedades<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Propiedades </li>
    </ol>
</section>

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

@if(Session::has('messageE'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-danger alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> - {{Session::get('messageE')}}
      </div>
    </div>
  </div>  
@endif

<div class="row">

	<div class="col-xs-3">
		<a href="{{ url('propiedad/create') }}"" class="btn btn-danger btn-flat">Agregar Propiedad</a>
	</div><br><br>
	
  	<div class="col-xs-12">
  		<div class="box box-danger">
			
  	    	<div class="box-header with-border">
  	    		<h3 class="box-title">Propiedades</h3>
  	    	</div>
		
  	    	<div class="box-body">
  	    	<div class="table-responsive">
  	    	  	<table class="table table-bordered table-hover table-striped" data-ruta="estadoPropiedad">
  	    	  		<thead>
  	    	  			<tr>
                    <th>Nombre de la Propiedad</th>
  	    	  				<th>Ciudad</th>
  	    	  				<th class="centro">Estado</th>
  	    	  				<th class="centro">Acciones</th>
  	    	  			</tr>
  	    	  		</thead>
  	    	  		<tbody>
  	    	  		@foreach($propiedades as $propiedad)
  	    	  		@if($propiedad->PRO_ESTADO)
  	    	  			<tr data-id="{{ $propiedad->PRO_IDPROPIEDAD }}">
  	    	  		@else
  	    	  			<tr data-id="{{  $propiedad->PRO_IDPROPIEDAD }}" class="changeEstate">
  	    	  		@endif
                    <td>{{ $propiedad->PRO_NOMBRE }}</td>
  	    	  				<td>{{ $propiedad->CIU_NOMBRE }}</td>
  	    	  				<td class="centro">
  	    	  					<input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($propiedad->PRO_ESTADO == 1) checked @endif >
  	    	  				</td>
  	    	  				<td class="centro">
  	    	  					<a class="btn btn-primary btn-sm" href="propiedad/{{ $propiedad->PRO_IDPROPIEDAD }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>

  	    	  					<a class="btn btn-info btn-sm" href="{{ url('inmueble_index/'.$propiedad->PRO_IDPROPIEDAD) }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Administrar Inmuebles"><span class="glyphicon glyphicon-home"></span></a>
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

