@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Inventario General<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Administrar Inventarios</li>
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

<!-- Ventana modal editar Articulo-->

<div class="example-modal">
  <div class="modal modal-default" id="editModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Artículo</h4>
        </div>
        <div class="modal-body">
          <div id="consultarInventario"></div>
        </div>
        <div class="modal-footer">
          
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-3">
      <a href="{{ url('propiedad') }}" class="btn btn-danger btn-flat">Agregar Artículos</a>
  </div><br><br>
  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Inventario <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por Propiedad o por Artículo " data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
         <label for="nombreEmp">Propiedad</label>
             <select class="form-control miselect" id="propiedades">
                  <option value="0">Seleccione...</option>
                  @foreach($propiedades as $prop)
                  <option value="{{$prop->PRO_IDPROPIEDAD}}">{{$prop->PRO_NOMBRE}}</option>
                  @endforeach
             </select>
        </div>
        <div class="col-md-3">
          <label for="nombrePais">Artículo</label>
          <select class="form-control miselect" id="articulos">
                  <option value="0">Seleccione...</option>
                  @foreach($articulo as $art)
                  <option value="{{$art->ART_IDARTICULO}}">{{$art->ART_NOMBRE}}</option>
                  @endforeach
             </select>
        </div>
        
        <div class="col-md-3">
          <button style="margin-top:23px" type="button" id="buscarArti" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
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
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Lista de Atículos del Inventario</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoCiudad">
            <thead>
              <tr>
                <th class="centro">Propiedad</th>
                <th class="centro">Inmueble</th>
                <th class="centro">Artículo</th>
                <th class="centro">Cantidad</th>
                <th class="centro">Modificar</th>
           
              </tr>
            </thead>
            <tbody>
                <tr data-id="">
                <tr data-id="" class="changeEstate">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="centro">
                  </td>
                  <td class="centro">
                  </td>
                </tr>
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
