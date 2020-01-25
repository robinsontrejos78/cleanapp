@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>


<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Servicio de Mantenimiento</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        <div class="col-md-12">
        	<label for="propidead">Propiedad: </label>
        	{{ $orden->PRO_NOMBRE }}
        </div>
        <div class="col-md-12">
        	<label for="direccion">Dirección: </label>
        	{{ $orden->INM_DIRECCION }}
        </div>
        <div class="col-md-12">
        	<label for="mantenimiento">Mantenimiento: </label>
        	{{ $orden->ORD_DESCRIPCION }}
        </div>
        <div class="col-md-12">
        	<label for="imagen">Evidencia: </label>
        	<input type="file" accept="image/*" id="BSbtninfo" capture="camera">
        </div>
        <div class="col-md-12">
        	<a href="#" class="btn btn-primary btn-sm" style="margin-top:20px">Guardar Evidencia</a>
        </div>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

@endsection