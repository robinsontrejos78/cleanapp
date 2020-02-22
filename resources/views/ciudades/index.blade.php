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
  <div class="col-xs-3">
      <a href="{{ url('ciudad/create') }}" class="btn btn-primary btn-flat">Agregar Ciudad</a>
  </div><br><br>
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Ciudades <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por Ciudad o Pais" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="nombreCiu">Ciudad</label>
          <input type="text" class="form-control" id="nombreCiu" placeholder="Ciudad o Municipio">
        </div>
        <div class="col-md-3">
          <label for="nombrePais">Departamento</label>
          <input type="text" class="form-control" id="nombrePais" placeholder="Depto">
        </div>
        
        <div class="col-md-3">
          <button style="margin-top:23px" type="button" id="buscarCiu" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
        </div>
      </div>

      <div class="box-footer">
        <div class="busqueda"></div>
      </div>
           
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Lista de Ciudades y Paises</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoCiudad">
            <thead>
              <tr>
                <th class="centro">Pais</th>
                <th class="centro">Ciudad</th>
                <th class="centro">Estado</th>
                <th class="centro">Acciones</th>
           
              </tr>
            </thead>
            <tbody>
              @foreach($ciudades as $ciudad)
                @if($ciudad->CIU_ESTADO)
                <tr data-id="{{ $ciudad->CIU_IDCIUDAD }}">
                @else
                <tr data-id="{{ $ciudad->CIU_IDCIUDAD }}" class="changeEstate">
                @endif
                  <td>{{ $ciudad->CIU_NOMBRE}}</td>
                  <td>{{ $ciudad->CIU_PAIS }}</td>
                
                  <td class="centro">
                      <meta name="_token" content="{{ csrf_token() }}"/>

                      <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $ciudad->CIU_NOMBRE }}" @if($ciudad->CIU_ESTADO) checked @endif >

                      <div class="slider round" title="Cambiar Estado" data-toggle="tooltip" data-placement="top"></div>
                  </td>
                  <td class="centro">
                 
                    <a class="btn btn-primary btn-sm" href="ciudad/{{ $ciudad->CIU_IDCIUDAD }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
                  </td>
                </tr>
              @endforeach
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
