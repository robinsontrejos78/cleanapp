@extends('layouts.app')

@section('main-content')

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Inmuebles<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Inmuebles </li>
        <li class="active"> Agregar Inmueble </li>
    </ol>
</section>

@if (count($errors) > 0)
	<div class="callout callout-danger">
		<h4>Errores!</h4>
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
@endif

<div class="row">
	<div class="col-xs-12">
  		<div class="box box-danger">
    		<div class="box-header with-border">
    			<h3 class="box-title">Agregar Inmueble</h3>
    		</div>
		
  	    	<div class="box-body">

  	    		<form action="{{ url('inmueble_store/'.$id) }}" method="POST">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id_propiedad" value="{{ $id }}">
              <div class="col-xs-6">
                  <h4>Tipo</h4>
                  <select name="tipo_Inm" id="" class="form-control">
                    <option value="">Seleccione...</option>
                    @foreach($tipos as $tipo)
                      <option value="{{ $tipo->LOO_IDLOOKUP }}" @if($tipo->LOO_IDLOOKUP == old('tipo_Inm')) selected @endif>{{ $tipo->LOO_DESCRIPCION }}</option>
                    @endforeach
                  </select>
                </div>

  	    			<div class="col-xs-6">
  	    	  	  <h4>Dirección</h4>
  	    	  	  <input type="text" name="direccion" class="form-control" placeholder="Direccion del Inmueble" value="{{ old('direccion') }}">
  	    	  	</div>

              <div class="col-xs-6">
                <h4>Nombre Contacto</h4>
                <input type="text" name="nombre" class="form-control" placeholder="Persona Responsable" value="{{ old('nombre') }}">
              </div>

              <div class="col-xs-6">
                <h4>Teléfono Contacto</h4>
                <input type="number" name="telefono" class="form-control" placeholder="Telefono de Contacto" value="{{ old('telefono') }}">
              </div>

              <div class="col-xs-6">
                <h4>Correo Electrónico Contacto</h4>
                <input type="email" name="email" class="form-control" placeholder="Email Contacto" value="{{ old('email') }}">
              </div>
  	    	  		
  	    	  	<div class="col-xs-12"><br>
  	    	  		<button type="submit" class="btn btn-success btn-flat">Guardar</button>
  	    	  		<a href="{{ url('inmueble_index/'.$id) }}" class="btn btn-danger btn-flat">Cancelar</a>
  	    	  	</div>
  	    		</form>
  	    	  	
  	    	</div>
  	  	</div>
  	</div>
</div>

@endsection