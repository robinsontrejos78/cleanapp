@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

@if (count($errors) > 0)
  <div class="alert alert-primary">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-info">

      <div class="box-header with-border">
        <h3 class="box-title">Editar Orden</h3>
      </div>

      <div class="box-body">
        <form action="{{ url('orden/'.$orden->ORD_IDORDEN) }}" method="POST" class="form-group deshabilita">
          <input type="hidden" name="_method" value="PUT">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-6">
            <label for="inmueble">Dirección</label>
            <input type="text" name="inmueble" value="{{ $temporal->ORD_INM_IDINMUEBLE }}" id="inmueble" class="form-control inmueble">
          </div>
       <div class="col-md-6">
          <label for="tipoOrden">Tipo de Orden</label>
          <select name="tipoOrden" id="tipoOrden" class="form-control tipoOrden">
            <option value="">Seleccione opción</option>
            @foreach($tipoOrden as $tipo)
              <option value="{{ $tipo->LOO_IDLOOKUP }}">{{ $tipo->LOO_DESCRIPCION }}</option>
            @endforeach
          </select>
        </div>

      <div class="col-md-6">
          <label for="profesional">Profesional</label>
          <select name="profesional" id="profesional" class="form-control tipoOrden" >
            <option value="">Seleccione opción</option>
            @foreach($profesional as $prof)
              <option value="{{ $prof->id }}">{{ $prof->name }} {{ $prof->USR_APELLIDOS }}</option>
            @endforeach
          </select>
        </div>
          
          <div class="col-md-6">
            <label for="Fecha">Fecha</label>
            <?php $fecha = strftime('%Y-%m-%d', strtotime($orden->ORD_FECHAORDEN)); ?>
            <input type="datetime-local" name="Fecha" class="form-control" value="{{ $fecha }}">
          </div>

          <div class="col-md-12" style="margin-top:30px">
            <input type="submit" name="editarOrden" value="Modificar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Editar Orden">
            <a href="{{ url('orden') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Personal">Cancelar</button></a>
          </div>  
        </form>
      </div>

      <div class="box-footer">
       	
      </div>
           
    </div>
  </div>
</div>

@endsection