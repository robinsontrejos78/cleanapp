@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Empresas<small>Módulo Super Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url ('home') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Administrar Empresas</li>
    </ol>
</section>

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
    <a href="{{ url('empresa/create') }}"" class="btn btn-danger btn-flat">Agregar Empresa</a>
  </div><br><br>

  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Empresa <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por Nombre de empresa, Contacto o email" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="nombreEmp">Nombre</label>
        	<input type="text" class="form-control" id="nombreEmp" placeholder="Nombre de la Empresa">
        </div>
        <div class="col-md-3">
          <label for="nombreCon">Contacto</label>
        	<input type="text" class="form-control" id="nombreCon" placeholder="Nombre de Contacto">
        </div>
        <div class="col-md-3">
          <label for="correoElec">Email</label>
        	<input type="text" class="form-control" id="correoElec" placeholder="Correo Electrónico">
        </div>
        <div class="col-md-3">
        	<button style="margin-top:23px" type="button" id="buscarEmp" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
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
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Lista de Empresa</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" data-ruta="cambioEstadoEmp">
          	<thead>
          		<tr>
  	        		<th class="centro">Nombre de la Empresa</th>
  	        		<th class="centro">Contacto</th>
  	        		<th class="centro">Teléfono</th>
  	        		<th class="centro">Correo Electrónico</th>
  	        		<th class="centro">Estado</th>
  	        		<th class="centro">Acciones</th>
  	        	</tr>
          	</thead>
          	<tbody>
          		@foreach($empresas as $empresa)
          			@if($empresa->EMP_ESTADO)
                <tr data-id="{{ $empresa->EMP_IDEMPRESA }}" >
                @else
                <tr data-id="{{ $empresa->EMP_IDEMPRESA }}" class="changeEstate">
                @endif
          				<td>{{ $empresa->EMP_NOMBRE }}</td>
          				<td>{{ $empresa->EMP_CONTACTO }}</td>
          				<td>{{ $empresa->EMP_TELEFONO }}</td>
          				<td>{{ $empresa->EMP_CORREO }}</td>
          				<td class="centro">
                        <meta name="_token" content="{{ csrf_token() }}"/>
                        @if($empresa->EMP_ESTADO) 
                            <input type="checkbox" class="checkIcon1" data-group-cls="btn-group-sm" name="estado" value="{{ $empresa->EMP_ESTADO }}" checked>
                        @else
                            <input type="checkbox" class="checkIcon1" data-group-cls="btn-group-sm" name="estado" value="{{ $empresa->EMP_ESTADO }}">
                        @endif 
                        <div class="slider round" title="Cambiar Estado" data-toggle="tooltip" data-placement="top"></div>
                  </td>
          				<td class="centro">
          					<a class="btn btn-primary btn-sm" href="empresa/{{ $empresa->EMP_IDEMPRESA }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
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