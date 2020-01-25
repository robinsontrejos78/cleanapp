@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>{{Session::get('nombreEmpresa')}} - Reportes<small>Módulo Administrador</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-home"></i>Inicio</a></li>
        <li class="active">Reportes</li>
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
 
  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Reporte Por:<span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="nombreCiu">Ciudad</label>
            <select class="form-control gestionador" id="busCiu">
                  <option value="" selected="selected">Seleccione...</option>
                   @foreach($ciudad as $ciu)
                 <option value="{{$ciu->CIU_IDCIUDAD}}">{{ $ciu->CIU_NOMBRE }}</option>
                 @endforeach
              </select>
        </div>
        <div class="col-md-3">
          <label for="nombrePro">Propiedad</label>
          <select class="form-control gestionador" id="busProp">
                  <option value="" selected="selected">Seleccione...</option>
                   @foreach($propiedades as $prop)
                 <option value="{{$prop->PRO_IDPROPIEDAD}}" >{{ $prop->PRO_NOMBRE }}</option>
                 @endforeach
              </select>
        </div>
            <div class="col-md-3">
          <label for="nombrePais">Artículos</label>
           <select class="form-control gestionador" id="busArt">
                  <option value="" selected="selected">Seleccione...</option>
                   @foreach($articulo as $art)
                 <option value="{{$art->ART_IDARTICULO}}" >{{ $art->ART_NOMBRE }}</option>
                 @endforeach
              </select>
        </div>
        
        <div class="col-md-3">
          <button style="margin-top:23px" type="button" id="busreporte" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
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
        <h3 class="box-title">Resultado</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoCiudad">
            <thead>
              <tr>
                 <th class="centro">Ciudad</th>
                 <th class="centro">Propiedad</th>
                 <th class="centro">Artículo</th>
                 <th class="centro">Cantidad</th>
                 <th class="centro">Dirección</th>
              </tr>
            </thead>
            <tbody>
                <tr data-id="">
                <tr data-id="" class="changeEstate">
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
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
