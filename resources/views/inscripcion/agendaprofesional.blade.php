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
        <h3 class="box-title">Programador de fechas laborables <span class="badge bg-teal"  data-toggle="tooltip" title="Puedes escoger los dias y las horas en las que puedes trabajar" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>
      <div class="box-body">
        <div class="col-md-4">
                <label>Elige el Día</label>
                 <input type="date" id="fechaagenda" class="form-control">
        </div>
        <div class="col-md-4">
                <label>Hora Inicial</label>
                <th class="centro"> <input type="time" id="horainicio" class="form-control">
        </div>
        <div class="col-md-4">
                <label>Hora Final</label>
                <th class="centro"> <input type="time" id="horafinal" class="form-control">
        </div>
      </div>
        <div class="col-md-3" >
          <button style="margin-top:23px" type="button" id="registraragenda" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Registrar Fecha</button>
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
        <h3 class="box-title">Registro histórico de fechas Laborables </h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" data-ruta="cambioEstadoEmp">
            <thead>
              <tr>
                <th class="centro">Día</th>
                <th class="centro">Hora Inicial</th>
                <th class="centro">Hora Final</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registros as $registro)
                @if($registro->ind)
                <tr data-id="{{ $registro->ind }}" >
                @else
                <tr data-id="{{ $registro->ind }}" class="changeEstate">
                @endif
                  <td class="centro">{{ $registro->ind_dia }}</td>
                  <td class="centro">{{ $registro->id_horainicio }}</td>
                  <td class="centro">{{ $registro->id_horafinal }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection