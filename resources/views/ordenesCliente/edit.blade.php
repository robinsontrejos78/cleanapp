@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"> Editar Orden</li>
    </ol>
</section>

@if (count($errors) > 0)
  <div class="alert alert-primary">º
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
            <label for="inmueble">Inmueble</label>
            <select name="inmueble" id="inmueble" class="form-control inmueble">
              @foreach($inmuebles as $inmueble)
                <option value="{{ $inmueble->INM_IDINMUEBLE }}" @if($orden->ORD_INM_IDINMUEBLE == $inmueble->INM_IDINMUEBLE) selected @endif>{{ $inmueble->INM_DIRECCION }}</option>
              @endforeach
            </select>
          </div>
          
<!--           <div class="col-md-6">
            <label for="persona">Persona</label>
            <select name="persona" id="persona" class="form-control tipoPersona">
              @foreach($personas as $persona)
                <option value="{{ $persona->id }}" @if($persona->id == $orden->ORD_USR_ID) selected @endif>{{-- $persona->name --}} {{-- $persona->USR_APELLIDOS --}}</option>
              @endforeach            
            </select>
          </div> -->
          
          <div class="col-md-6">
            <label for="Fecha">Fecha</label>
            <?php $fecha = strftime('%Y-%m-%d', strtotime($orden->ORD_FECHAORDEN)); ?>
            <input type="date" name="Fecha" class="form-control" value="{{ $fecha }}">
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