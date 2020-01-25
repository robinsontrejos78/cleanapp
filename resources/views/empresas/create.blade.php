@extends('layouts.app')

@section('main-content')

<section class="content-header" style="margin-bottom:30px">
    <h1>Crear Empresa<small>Módulo Super Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url ('home') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Creación de Empresas</li>
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
        <h3 class="box-title">Crear Empresa</h3>
      </div>

      <div class="box-body">
	    <form action="{{ url('empresa') }}" method="POST" class="form-group deshabilita">
	    	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	        <div class="col-md-6">
	        	<label for="nombreEmp" style="margin-top:20px">Nombre</label>
	        	<input type="text" class="form-control" id="nombreEmp" name="nombreEmp" placeholder="Nombre de la Empresa" value="{{ old('nombreEmp') }}">
	        </div>
	        <div class="col-md-6">
	        	<label for="nombreCon" style="margin-top:20px">Contacto</label>
	        	<input type="text" class="form-control" id="nombreCon" name="nombreCon" placeholder="Nombre de Contacto" value="{{ old('nombreCon') }}">
	        </div>
	        <div class="col-md-6">
	        	<label for="telefonoEmp" style="margin-top:20px">Teléfono</label>
	        	<input type="text" class="form-control" id="telefonoEmp" name="telefonoEmp" placeholder="Teléfono de Contacto" value="{{ old('telefonoEmp') }}">
	        </div>
	        <div class="col-md-6">
	        	<label for="emailCon" style="margin-top:20px">Email</label>
	        	<input type="email" class="form-control" id="emailCon" name="emailCon" placeholder="Correo electrónico" value="{{ old('emailCon') }}">
	        </div>
	        <div class="col-md-1 col-md-offset-9" style="margin-top:30px">
	        	<input type="submit" name="guardarEmpresa" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear empresa">
	        </div>
	        <div class="col-md-1" style="margin-top:30px">
	        	<a href="{{ url('empresa') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Empresas">Cancelar</button></a>
	        </div>
		</form>
      </div>

      <div class="box-footer">
       	
      </div>
           
    </div>
  </div>
</div>

@endsection