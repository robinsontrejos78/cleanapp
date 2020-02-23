@extends('layouts.app')

@section('main-content')

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
    <div class="box box-blue">

      <div class="box-header with-border">
        <h3 class="box-title">Editar Ciudad</h3>
      </div>

      <div class="box-body">
       <form action="{{ url('ciudad/'.$ciudad->CIU_IDCIUDAD) }}" method="POST" class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="_method" value="PUT">
          <div class="col-md-6">
            <label for="nombreCiu" style="margin-top:20px">Ciudad</label>
            <input type="text" class="form-control" id="nombreCiu" name="nombreCiu" placeholder="Nombre de la Ciudad" value="{{ $ciudad->CIU_NOMBRE }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="nombrePais" style="margin-top:20px">Pais</label>
            <input type="text" class="form-control" id="nombrePais" name="nombrePais" placeholder="Nombre del Pais" value="{{ $ciudad->CIU_PAIS }}" onkeyup="this.value=this.value.toUpperCase();">
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