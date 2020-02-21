@extends('layouts.app')

@section('htmlheader_title')
  Home
@endsection


@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>


<div class="example-modal">
  <div class="modal modal-default" id="imagenmodal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información de la novedad</h4>
        </div>
        <div class="modal-body">
          <div class="insertarimagen">
            
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


@if(Auth::user()->hasRole('Administrador'))
  
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Servicios Terminados</h3>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box" style="margin-top:20px">
            <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Novedades</span>
              <span class="info-box-number contador">{{ $contador }}</span>
            </div>
           </div>
      </div>
     <div class="box-footer">
     </div>
     </div>
  </div>
</div>  

<div class="resultado">
  
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
            <thead>
              <tr>
                <th class="centro">Fecha del Servicio</th>
                <th class="centro">Dirección</th>
                <th class="centro">Propietario</th>
                <th class="centro">Teléfono</th>
                <th class="centro">Generado por</th>
                <th class="centro">Terminar Novedad</th>
                </tr>
            </thead>
            <tbody>
              @foreach($novedades as $novedad)
                <tr>
                  <td class="centro" >{{ $novedad->ORD_FECHAORDEN }}</td>
                  <td class="centro" >{{ $novedad->PRO_NOMBRE }} - {{ $novedad->INM_DIRECCION }}</td>
                  <td class="centro" >{{ $novedad->INM_PROPIETARIO }} </td>
                  <td class="centro" >{{ $novedad->INM_TELEFONO }} </td>
                  <td class="centro" >{{ $novedad->name }} {{ $novedad->USR_APELLIDOS }}</td>
                  <td class="centro">
        				    <button class="btn btn-info btn-sm terminarnovedad" data-idnov="{{$novedad->NOV_IDNOVEDAD}}"><i class="fa fa-fw fa-thumbs-o-up"></i> </button>
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

@endif

@if(Auth::user()->hasRole('Profesional'))
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <a href="{{ url('ordenP') }}">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-fw fa-arrow-right"></i></span>
        <div class="info-box-content">
          <span class="info-box-text"></span>
          <span class="info-box-number">Ordenes de servicio</span>
        </div>
      </div>
    </a>
  </div>
</div>


@endif


@if(Auth::user()->hasRole('Cliente'))
  <div class="container">
    <div class="row" >
      <div class="col-sm-6 col-md-3"></div>
      <div class="col-sm-6 col-md-6" >
        <div class="thumbnail">


        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          <li class="nav-item">
            <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
          </li>
          <li class="nav-item" >
            <a class="nav-link active" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="true">Contact</a>
          </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade active in" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      
            <div class="row">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                        <thead>
                          <tr>
                            <th class="centro"></th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <th class="centro">PLAN 1 (2) HORAS $22.000</th>
                          </tr>
                          <tr>
                            <th class="centro">PLAN 2 (4) HORAS $35.000</th>
                          </tr>
                          <tr>
                            <th class="centro">PLAN 3 (6) HORAS $48.000</th>
                          </tr>
                          <tr>
                            <th class="centro">PLAN 4 (8) HORAS $60.000</th>
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

          </div>
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      

          <div class="row">  
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                      <thead>
                        <tr>
                          <th class="centro">PLAN #</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                          <th class="centro">ANEXO</th>
                          <TEXTAREA></TEXTAREA>
                        </tr>
                        <tr>
                          <th class="centro">Adicional 1</th>
                        </tr>
                        <tr>
                          <th class="centro">Adicional 2</th>
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

          </div>
          <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
      
          <div class="row">  
            <div class="col-md-12">
              <div class="box box-primary">
                <div class="box-header with-border">
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                      <thead>
                        <tr>
                          <th class="centro">Titulo</th>
                        </tr>
                      </thead>
                      <tbody>
                          <tr>
                          <th class="centro">Fecha del Servicio</th>
                        </tr>
                        <tr>
                          <th class="centro">Fecha del Servicio</th>
                        </tr>
                        <tr>
                          <th class="centro">Fecha del Servicio</th>
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

        </div>
      </div>

          
  


        </div>
      </div>
      <div class="col-sm-6 col-md-3"></div>
    </div>
  </div>


  

 <!--  <div class="container">
    <div class="row" >
      @foreach($profesionales as $profesional)
      <div class="col-sm-6 col-md-3" >
        <div class="thumbnail">
          <img src="{{ asset ($profesional->PRO_foto)}}" alt="...">
          <div class="caption">
            <h3>{{$profesional->PRO_nombresprof}} {{$profesional->PRO_apellidosprof}}</h3>
            <p>
              <a class="btn btn-default" onclick="verDispProf({{$profesional->id}})" role="button">Ver disponibilidad</a>
            </p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div> -->

@endif

@endsection