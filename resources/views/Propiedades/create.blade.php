@extends('layouts.app')

@section('main-content')

<section class="content-header" style="margin-bottom:30px">
    <h1>Propiedades<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Home</a></li>
        <li class="active"> Propiedades </li>
        <li class="active"> Agregar Propiedad </li>
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
  	    		<h3 class="box-title">Agregar Propiedad</h3>
  	    	</div>
		
  	    	<div class="box-body">

  	    		<form action="{{ url('propiedad') }}" method="POST">
  	    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
  	    			<div class="col-xs-6">
  	    	  			<h4>Nombre</h4>
  	    	  			<input type="text" name="nombre" class="form-control" placeholder="Nombre de la Propiedad" value="{{ old('nombre') }}">
  	    	  		</div>
                <div class="col-xs-6">
                  <h4>Ciudad</h4>
                  <select name="ciudad" id="" class="form-control">
                    <option value="">Seleccione...</option>
                    @foreach($ciudades as $ciudad)
                      <option value="{{ $ciudad->CIU_IDCIUDAD }}" @if($ciudad->CIU_IDCIUDAD == old('ciudad')) selected @endif>{{ $ciudad->CIU_NOMBRE }}</option>
                    @endforeach
                  </select>
                </div>

  	    	  		<div class="col-xs-12"><br>
  	    	  			<button type="submit" class="btn btn-success btn-flat">Guardar</button>
  	    	  			<a href="{{ url('propiedad') }}" class="btn btn-danger btn-flat">Cancelar</a>
  	    	  		</div>
  	    		</form>
  	    	  	
  	    	</div>

  	  	</div>
  	</div>
</div>



@endsection