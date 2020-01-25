@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>


@if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif


  
<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Cantidad de Solicitudes Pendientes</h3>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box" style="margin-top:20px">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total</span>
              @foreach($contador as $cont)
              <span class="info-box-number contador">{{ $cont->total }}</span>
               @endforeach
            </div>
           </div>
      </div>
     <div class="box-footer">
     </div>
     </div>
  </div>
</div>  


<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Mostrar Inscripción Profesional</h3>
      </div>

      <div class="box-body">
          <div class="col-md-4">
            <label for="nombrePer" style="margin-top:20px">Fecha Inscripción</label>
            <input type="date" class="form-control" id="fechaprof" >
          </div>
          <div class="col-md-4">
            <label for="documentoPer" style="margin-top:20px">Documento</label>
            <input type="text" class="form-control" id="docuprof"  placeholder="Documento del usuario" >
          </div>
          <div class="col-md-4">
            <label for="telefonoPer" style="margin-top:20px">Nombre</label>
            <input type="text" class="form-control" id="nombreprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombre" >
          </div>
          <div class="col-md-6">
          <button style="margin-top:23px" type="button" id="buscarprof" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
          </div>
          
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-success">

      <div class="box-header with-border">
        <h3 class="box-title">Datos</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoCiudad" id="testTable">
            <thead>
       
            </thead>
            <tbody>


            </tbody>
          </table>
 

        </div>
      </div>
   
  </div>
</div>
@endsection