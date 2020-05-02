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
    <div class="box box-primary">
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
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Mostrar Inscripción Profesional</h3>
      </div>

      <div class="box-body">
          <div class="col-md-3">
            <label for="nombrePer" style="margin-top:20px">Fecha Inscripción</label>
            <input type="date" class="form-control" id="fechaprof" >
          </div>
          <div class="col-md-3">
            <label for="documentoPer" style="margin-top:20px">Documento</label>
            <input type="text" class="form-control" id="docuprof"  placeholder="Documento del usuario" >
          </div>
          <div class="col-md-3">
            <label for="telefonoPer" style="margin-top:20px">Nombre</label>
            <input type="text" class="form-control" id="nombreprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombre" >
          </div>
          <div class="col-md-3">
            <label for="telefonoPer" style="margin-top:20px">Apellido</label>
            <input type="text" class="form-control" id="apellidoprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Apellido" >
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
  <tr>
    <th class="centro">Nombre y Apellido</th>
    <th class="centro">Tipo Documento</th>
    <th class="centro">Número</th>
    <th class="centro">Fecha/Nacimiento</th>
    <th class="centro">Genero</th>
    <th class="centro">Lugar/Nacimiento</th>
    <th class="centro">Ant/Ciudad</th>
    <th class="centro">Estado Civil</th>
    <th class="centro">Dirección</th>
    <th class="centro">Celular</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Correo</th>
    <th class="centro">Nivel/Estudios</th>
    <th class="centro">Personas/Cargo</th>
    <th class="centro">Conyugue</th>
    <th class="centro">Tipo Documento</th>
    <th class="centro">Número</th>
    <th class="centro">Ref/ Familiar</th>
    <th class="centro">Parentesco</th>
    <th class="centro">Ciudad</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Ref/ Comercial/Personal</th>
    <th class="centro">Parentesco</th>
    <th class="centro">Ciudad</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Acción</th>
  </tr>
</thead>
<tbody>
  @foreach($resultados as $res)
    @if($res->id)
    <tr data-id="{{ $res->id }}">
    @else
    <tr data-id="{{ $res->id }}" class="changeEstate">
    @endif
      <td>{{ $res->PRO_nombresprof }} {{ $res->PRO_apellidosprof }}</td>
      <td>{{ $res->PRO_tipodocprof }}</td>
      <td>{{ $res->PRO_numdocprof }}</td>
      <td>{{ $res->PRO_fnaciprof }}</td>
      <td>{{ $res->PRO_generoprof }}</td>
      <td>{{ $res->PRO_lugarnacprof }}</td>
      <td>{{ $res->PRO_antigprof }}</td>
      <td>{{ $res->PRO_estcivilprof }}</td>
      <td>{{ $res->PRO_dirprof }}</td>
      <td>{{ $res->PRO_telprof }}</td>
      <td>{{ $res->PRO_telresprof }}</td>
      <td>{{ $res->PRO_mailprof }}</td>
      <td>{{ $res->PRO_nivelprof }}</td>
      <td>{{ $res->PRO_percarprof }}</td>
      <td>{{ $res->PRO_nomcon }} {{ $res->PRO_apecon }}</td>
      <td>{{ $res->PRO_tipodoccon }}</td>
      <td>{{ $res->PRO_numerodoccon }}</td>
      <td>{{ $res->PRO_nombrefa }} {{ $res->PRO_aperefa }}</td>
      <td>{{ $res->PRO_parentrefa }}</td>
      <td>{{ $res->PRO_citirefa }}</td>
      <td>{{ $res->PRO_telrefa }}</td>
      <td>{{ $res->PRO_nomrefcoma }} {{ $res->PRO_aperefcoma }}</td>
      <td>{{ $res->PRO_parentrefcoma }}</td>
      <td>{{ $res->PRO_citicoma }}</td>
      <td>{{ $res->PRO_telrefcoma }}</td>
      <td class="centro">
        <a class="btn active btn-danger" id="descartar" data-id="{{ $res->id }}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Descartar Inscripción" data-container="body"><span class="glyphicon glyphicon-remove"></span></a>
      </td>
 
 </tr>

  @endforeach
</tbody>
          </table>
 

        </div>
      </div>
   
  </div>
</div>
@endsection