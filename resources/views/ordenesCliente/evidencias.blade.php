@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<!-- Ventana modal ver imagenes-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Evidencia</h4>
        </div>
        <div class="modal-body">
          
          <div class="verImagenesE">
            
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

@if($tipoOrden == 1)
<div class="row">
  <div class="col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Evidencias. Aseo realizado por {{ $datos->name }} {{ $datos->USR_APELLIDOS }}, en el inmueble {{ $datos->INM_DIRECCION }}</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        
        @foreach($evidenciasAseos as $evidencia)
          <div class="col-xs-6 col-md-3">
              <div class="thumbnail">
                <img src="../../image/evidencias/{{$evidencia->EVI_IMAGEN}}" class="verImagen" alt="" data-toggle="tooltip" title="{{$evidencia->EVI_DESCRIPCION}}" height="" width="">
              </div>
          </div>
        @endforeach

      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Evidencias Finales. {{ $datos->name }} {{ $datos->USR_APELLIDOS }}, en el inmueble {{ $datos->INM_DIRECCION }}</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        
        @foreach($evidenciasCheckout as $evidencia)
          <div class="col-xs-6 col-md-3">
              <div class="thumbnail">
                <img src="../../image/evidencias/{{$evidencia->EVI_IMAGEN}}" class="verImagen" alt="" data-toggle="tooltip" title="{{$evidencia->EVI_DESCRIPCION}}" height="" width="">
              </div>
          </div>
        @endforeach

      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>
@endif

@if($tipoOrden == 2)
<div class="row">
  <div class="col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Evidencias de Mantenimiento realizado por {{ $datos->name }} {{ $datos->USR_APELLIDOS }}, en el inmueble {{ $datos->INM_DIRECCION }}</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        
        @foreach($evidenciasMantenimiento as $evidencia)
          <div class="col-xs-6 col-md-3">
              <div class="thumbnail">
                <img src="../../image/evidencias/{{$evidencia->EVI_IMAGEN}}" class="verImagen" alt="" data-toggle="tooltip" title="{{$evidencia->EVI_DESCRIPCION}}" height="" width="">
              </div>
          </div>
        @endforeach

      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>
@endif

@if($tipoOrden == 3)
<div class="row">
  <div class="col-xs-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Evidencias de Inventario realizado por {{ $datos->name }} {{ $datos->USR_APELLIDOS }}, en el inmueble {{ $datos->INM_DIRECCION }}</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        @foreach($evidenciasInventario as $evidencia)
          <div class="col-xs-6 col-md-3">
              <div class="thumbnail">
                <img src="../../image/evidencias/{{$evidencia->EVI_IMAGEN}}" class="verImagen" alt="" data-toggle="tooltip" title="{{$evidencia->EVI_DESCRIPCION}}" height="" width="">
              </div>
          </div>
        @endforeach
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>
@endif

@endsection