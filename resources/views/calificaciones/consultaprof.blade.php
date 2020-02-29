@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>



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


  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Calificación de Profesional <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por Nombre de la persona, Apellido o email" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="nombreUsu">Nombre</label>
          <div class="form-group">
              <select name="tipodoc" id="nombreUsu" class="form-control" >
                  <option>Seleccione Nombre</option>
                  @foreach($nomb as $nombre)
                  <option value="{{ $nombre->id }}">{{ $nombre->name }} {{ $nombre->USR_APELLIDOS }}</option>
                  @endforeach
              </select>
          </div>
      </div>
        <div class="col-md-3">
          <button style="margin-top:23px" type="button" id="buscarcalprof" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
        </div>
      </div>

      <div class="box-footer">
        <div class="busqueda"></div>
      </div>
           
    </div>
  </div>
</div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Lista de Calificaciones</h3>
      </div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" >
            <thead>
              <tr>
                <th class="centro">Calificado por:</th>
                <th class="centro">Estrellas otorgadas</th>
                <th class="centro">Fecha</th>
                <th class="centro">Observación</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

@endsection