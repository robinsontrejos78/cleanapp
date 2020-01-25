@extends('layouts.app')

@section('main-content')

<section class="content-header" style="margin-bottom:30px">
    <h1>Crear Empresa<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url ('home') }}"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Creación de Ciudades</li>
    </ol>
</section>

@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
@endif

<div class="row">

  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Crear Ciudad</h3>
      </div>

      <div class="box-body">
	    <form action="{{ url('ciudad') }}" method="POST" class="form-group deshabilita">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <div class="col-md-6">
	        	<label for="nombreCiu" style="margin-top:20px">Ciudad</label>
	        	<input type="text" class="form-control" id="nombreCiu" name="nombreCiu" placeholder="Nombre de la Ciudad" value="{{ old('nombreCiu') }}" onkeyup="this.value=this.value.toUpperCase();">
	        </div>
	        <div class="col-md-6">
	        	<label for="nombrePais" style="margin-top:20px">Pais</label>
	        	<input type="text" class="form-control" id="nombrePais" name="nombrePais" placeholder="Nombre del Pais" value="{{ old('nombrePais') }}" onkeyup="this.value=this.value.toUpperCase();">
	        </div>	       
	        <div class="col-md-1 col-md-offset-9" style="margin-top:30px">
	        	<input type="submit" name="guardarEmpresa" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear empresa">
	        </div>
	        <div class="col-md-1" style="margin-top:30px">
	        	<a href="{{ url('ciudad') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Ciudades">Cancelar</button></a>
	        </div>
		</form>
      </div>

      <div class="box-footer">
       	
      </div>
           
    </div>
  </div>
</div>
@endsection