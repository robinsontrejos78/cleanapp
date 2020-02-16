@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"> Crear Orden</li>
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

@if(Session::has('message'))
    <div class="row">
      <div class="col-md-4 col-md-offset-4">
        <div class="alert alert-danger alert-dismissible" role="alert"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{Session::get('message')}}
        </div>
      </div>
    </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">

      <div class="box-header with-border">
        <h3 class="box-title">Nueva Orden</h3>
      </div>

      <div class="box-body">
      <form action="{{ url('orden') }}" method="POST" class="form-group deshabilita">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-6">
          <label for="inmueble">Inmueble</label>
          <select name="inmueble" id="inmueble" class="form-control inmueble">
            <option value="">Seleccione opción</option>
            @foreach($inmuebles as $inmueble)
              <option value="{{ $inmueble->INM_IDINMUEBLE }}" @if($inmueble->INM_IDINMUEBLE == old('inmueble')) selected @endif>{{ $inmueble->INM_DIRECCION }}</option>
            @endforeach
          </select>
        </div>

       
        <div class="col-md-6">
          <label for="Huespedes">Cantidad de Huespedes</label>
          <input type="number" name="huesped" class="form-control" value="{{ old('huesped') }}">
        </div>

        
        <div class="col-md-6">
          <label for="tipoOrden">Tipo de Orden</label>
          <select name="tipoOrden" id="" class="form-control tipoOrden" data-ruta="../selectTipoper">
            <option value="">Seleccione opción</option>
            @foreach($tipoOrden as $tipo)
              <option value="{{ $tipo->LOO_IDLOOKUP }}">{{ $tipo->LOO_DESCRIPCION }}</option>
            @endforeach
          </select>
        </div>
        
        <div class="col-md-6">
          <label for="persona">Persona</label>
          <select name="persona" id="persona" class="form-control tipoPersona">
            <option value="">Seleccione opción</option>
                        
          </select>
        </div>

        
        <div class="col-md-6">
          <label for="Fecha">Fecha</label>
          <input type="datetime-local" name="Fecha" class="form-control" value="{{ old('Fecha') }}">
        </div>

         <div class="col-md-6">
          <label for="costo">Costo</label>
          <input type="number" name="costo" class="form-control" value="{{ old('costo') }}">
        </div>

       
        <div class="col-md-6">
          <label for="ordDesc">Descripción</label>
          <textarea name="ordDesc" rows="4" class="form-control" style="margin-top:5px">{{ old('ordDesc')}}</textarea>
        </div>

       

        <div id="vacio">
          
        </div>
        <div class="col-md-12" style="margin-top:30px">
          <input type="submit" name="guardarOrden" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear Orden">
          <a href="{{ url('orden') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Personal">Cancelar</button></a>
        </div>  
        </div>
      </form>
        <div class="box-footer">
       	
        </div>
           
    </div>
  </div>
</div>

@endsection