@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


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

@if(Session::has('message'))
<div class="row">
  <div class="col-md-4 col-md-offset-4">
	<div class="alert alert-danger alert-dismissible" role="alert"><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span>
		<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
		{{Session::get('message')}}
	</div>
</div>
</div>
@endif


@if(Auth::user()->hasRole('Cliente'))
  <form id="formBuscarProf">
    <div class="container">
      <div class="row" >
        <div class="col-sm-6 col-md-3"></div>
        <div class="col-sm-6 col-md-6" >
          <div class="thumbnail"> 

            <div class="row" id="bloque1">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                  	<h3 class="box-title">Nueva Orden</h3>
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
                            <th class="centro">
                              <button type="button" class="btn btn-primary" onClick="selecPlan(1)">PLAN 1 (2) HORAS $22.000</button>
                            </th>
                          </tr>

                          <tr>
                            <th class="centro">
                              <button type="button" class="btn btn-primary" onClick="selecPlan(2)">PLAN 2 (4) HORAS $35.000</button>
                            </th>
                          </tr>

                          <tr>
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(3)">PLAN 3 (6) HORAS $48.000</button></th>
                          </tr>

                          <tr>  
                            <th class="centro"><button type="button" class="btn btn-primary" onClick="selecPlan(4)">PLAN 4 (8) HORAS $60.000</button></th>
                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="box-footer"></div> 
                </div>
              </div>
            </div>

            <div class="row" id="bloque2" style="display: none;">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title col-md-6" id="etiqPlanSel" ></h3>
                    <h3 class="box-title col-md-6" id="valplanSel" ></h3>
                    <!-- <div class="alert alert-primary col-md-6" role="alert" ></div>
                    <div class="alert alert-primary col-md-6" role="alert" id="valplanSel"></div> -->
                  </div>
                  <div class="box-body">


                    <div class="alert alert-primary" role="alert" id="anexoPlan"></div>

                    <div class="form-group" id="fAdicional1">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="CheckAdicional1">
                        <label class="form-check-label" for="CheckAdicional1">
                          Planchado
                        </label>
                      </div>
                    </div>

                    <div class="form-group"  id="fAdicional2">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="CheckAdicional2">
                        <label class="form-check-label" for="CheckAdicional2">
                          Preparación de alimentos
                        </label>
                      </div>
                    </div>
                      
                  </div>
                  <div class="box-footer">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-primary" onclick="mostrarOcultar('muestra','bloque1');mostrarOcultar('oculta','bloque2');">Atrás</button>
                    </div>
                    <div class="col-md-6">
                        <button type="button"class="btn btn-primary" onclick="mostrarOcultar('muestra','bloque3');mostrarOcultar('oculta','bloque2');">Siguiente</button>
                    </div>

                  </div>   
                </div>
              </div>
            </div>

      
            <div class="row" id="bloque3"  style="display: none;">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Calendario</h3>
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                        <thead></thead>

                        <tbody>
                          <div class="form-group col-md-12">
                              <div id='calendar' style="margin:2% auto;"></div>
                          </div>

                          <div class="form-group col-md-6 col-xs-7">
                            <h4>Fecha</h4>
                            <input id="fechaAsig" type="date" name="fechaAsig" disabled class="form-control" value="{{ old('fechaAsig') }}">
                          </div>
<!-- 
                          <div class="form-group  col-md-6 col-xs-5">
                            <h4>Hora +30</h4>
                            <input type="time" class="form-control" id="inputHoras" placeholder="--:--">
                          </div>
                 -->
                <div class="form-group">
                  <div class="col-sm-4">
                    <h4>Hora +30</h4>
                    <input type="time" class="form-control" id="inputHoras">
                  </div>
                </div>

                          <div class="form-group col-xs-12">
                            <h4>Dirección</h4>
                            <input type="text" class="form-control" id="InputDireccion" value="{{ $direccion }}">
                          </div>

                          <div class="form-group col-md-6">
                            <label >
                              <button type="button" class="btn btn-primary"  onclick="mostrarOcultar('muestra','bloque2');mostrarOcultar('oculta','bloque3');">Atrás</button>
                            </label>
                          </div>

                          <div class="form-group col-md-6">
                            <label >
                              <button type="button" class="btn btn-primary"  id="buscaProfOdenCli">Siguiente</button>
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
              <input type="hidden" id="idcliente" value="{{ auth::user()->id }}">
              <input type="hidden" id="valSelectado">
              <input type="hidden" id="nominacion" value="">
            </form>

            <div class="row" id="bloque4"></div>

          </div><!-- fin del thumbnail -->
        </div>

      </div>

    </div> <!-- fin del container -->
  

<!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalResumen">
  </button> -->

<div class="modal fade" id="modalResumen" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Resumen del servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>
          Profesional:<label for="lbl" id="modalProfesional"></label>
          <br><br>
          Fecha y Hora: <label for="lbl" id="modalFechaHora"></label>
          <br><br>
          Costo: <label for="lbl" id="modalCosto"></label>
          <br><br>
          Ver <a href="{{ asset('documentacion/Términos y condiciones.doc') }}">Condiciones</a> y
          <a href="{{ asset('documentacion/anexo.docx') }}">anexos</a>
          <br><br>

        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary cerrarModalResumen">OK</button>
      </div>
    </div>
  </div>
</div>  

<script src="{{ asset('js/fullCalendarv4.js') }}"></script>

@endif
@endsection