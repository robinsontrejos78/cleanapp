@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<!-- Ventana modal con informacion de Usuario-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información de Profesionales</h4>
        </div>
        <div class="modal-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <tbody id="consultarPersona">
                    
                </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

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
    <a href="{{ url('createPersona') }}" class="btn btn-danger btn-flat">Agregar Profesional</a>
  </div><br><br>

  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Persona <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por Nombre de la persona, Apellido o email" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="nombreUsu">Nombre</label>
          <input type="text" class="form-control" id="nombreUsu" placeholder="Nombre del Usuario" onkeyup="this.value=this.value.toUpperCase();">
        </div>
        <div class="col-md-3">
          <label for="apellidoUsu">Apellido</label>
          <input type="text" class="form-control" id="apellidoUsu" placeholder="apellido del Usuario" onkeyup="this.value=this.value.toUpperCase();">
        </div>
        <div class="col-md-3">
          <label for="correoElec">Email</label>
          <input type="text" class="form-control" id="correoElec" placeholder="Correo Electrónico" onkeyup="this.value=this.value.toLowerCase();">
        </div>
        <div class="col-md-3">
          <button style="margin-top:23px" type="button" id="buscarPer" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
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
        <h3 class="box-title">Lista de Usuarios</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
            <thead>
              <tr>
                <th class="centro">Nombre y Apellido</th>
                <th class="centro">Función</th>
                <th class="centro">Correo Electrónico</th>
                <th class="centro">Teléfono Móvil</th>
                <th class="centro">Estado</th>
                <th class="centro">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
                @if($user->USR_ESTADO)
                <tr data-id="{{ $user->id }}">
                @else
                <tr data-id="{{ $user->id }}" class="changeEstate">
                @endif
                  <td>{{ $user->name }} {{ $user->USR_APELLIDOS }}</td>
                  <td>{{ $user->LOO_DESCRIPCION }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->USR_CELULAR }}</td>
                  <td class="centro">
                    <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $user->USR_ESTADO }}" @if($user->USR_ESTADO) checked @endif >
                  </td>
                  <td class="centro">
                    <a class="btn btn-info btn-sm btn_modal3" data-table="Persona" data-show="show" data-id="{{ $user->id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Ver Detalles"><span class="glyphicon glyphicon-search"></span></a>
                    <a class="btn btn-primary btn-sm" href="editPer/{{ $user->id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
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