@extends('layouts.app')

@section('htmlheader_title')
  Home
@endsection


@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>


<div class="example-modal">
  <div class="modal modal-default" id="imagenmodal">
    <div class="modal-dialog modal-sm">
      <div class="modal-content" style="background-color:lightblue">
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
      <form>
  <p class="clasificacion">
    <label for="radio1">★</label>
    <input id="radio1" type="radio" name="estrellas" value="1">
    <label for="radio2">★</label>
    <input id="radio2" type="radio" name="estrellas" value="2">
    <label for="radio3">★</label>
    <input id="radio3" type="radio" name="estrellas" value="3">
    <label for="radio4">★</label>
    <input id="radio4" type="radio" name="estrellas" value="4">
    <label for="radio5">★</label>
    <input id="radio5" type="radio" name="estrellas" value="5">
  </p>
</form>

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
  <form>
    <div class="container">
      <div class="row" >
        <div class="col-sm-6 col-md-3"></div>
        <div class="col-sm-6 col-md-6" >
          <div class="thumbnail"> 

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
                            <th class="centro"> 
                              Seleccione el plan
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr>
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(1)">PLAN 1 (2) HORAS $22.000</button></th>
                          </tr>

                          <tr>
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(2)">PLAN 2 (4) HORAS $35.000</button></th>
                          </tr>

                          <tr>
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(3)">PLAN 3 (6) HORAS $48.000</button></th>
                          </tr>

                          <tr>  
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(4)">PLAN 4 (8) HORAS $60.000</button></th>
                          </tr>

                            <input type="text" id="valSelectado">
                       
                            </div>
                          </div>
                        </div>
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

         

          <div class="row">  
            <div class="col-md-12">
              <div class="box box-primary">
                <div cla
                ss="box-header with-border">
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                      <thead>

                        <div class="row">                        
                          <div class="form-group col-md-6">
                            <label >plan 1</label>
                          </div>
                          
                          <div class="form-group col-md-6">
                            <label >$22.000</label>
                          </div>
                        </div>

                      </thead>

                      <tbody>
                        
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">ANEXO</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Adicional 1</label>
                        </div>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          <label class="form-check-label" for="exampleCheck1">Adicional 2</label>
                        </div>

                        <div class="form-group col-md-6">
                          <label>
                            <button type="button" class="btn btn-primary">Atrás</button>
                          </label>
                        </div>

                        <div class="form-group col-md-6">
                          <label >
                            <button type="button" class="btn btn-primary">Siguiente</button>
                          </label>
                        </div>
                        
                      </tbody>
                    </table>
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
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                      <thead></thead>

                      <tbody>
                        <div class="form-group col-md-12">
                          <label for="calendar">Calendario</label>
                            <div id='calendar' style="margin:2% auto;"></div>
                            <input type="datetime-local" name="Fecha" class="form-control" value="{{ old('Fecha') }}">
                        </div>

                        <div class="form-group  col-md-12">
                          <label for="exampleFormControlInput1">Hora</label>
                          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="--:--">
                        </div>

                        <div class="form-group  col-md-12">
                          <label for="InputDireccion">Direccion</label>
                          <input type="text" class="form-control" id="InputDireccion" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                          <label >
                            <button type="button" class="btn btn-primary">Atrás</button>
                          </label>
                        </div>

                        <div class="form-group col-md-6">
                          <label >
                            <button type="button" class="btn btn-primary">Siguiente</button>
                          </label>
                        </div>
                      </tbody>

                    </table>
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
                </div>
                <div class="box-body">
                    
                      @foreach($profesionales as $profesional)
                      <div class="row" >
                        <div class="col-sm-1 col-md-3"></div>
                        <div class="col-sm-9 col-md-6" >
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
                        <div class="col-sm-3 col-md-3"></div>
                      </div>
                      @endforeach

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
</form>

<script src="{{ asset('js/fullCalendarv4.js') }}"></script>

@endif

@endsection