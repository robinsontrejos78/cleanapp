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
  <form>
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

                            <input type="text" id="idcliente" value="{{ auth::user()->id }}">
                            <input type="text" id="valSelectado">
                            <input type="text" id="nominacion" value="">
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
                  </div>
                  <div class="box-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoUsu">
                        <thead>

                          <div class="row">                        
                            <div class="form-group col-md-6" id='etiqPlanSel'>                            
                            </div>
                            
                            <div class="form-group col-md-6" id="valplanSel">                            
                            </div>
                          </div>

                        </thead>

                        <tbody>
                          
                          <div class="form-group">
                            <label for="lbl" id="anexoPlan"></label>
                            <!-- <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea> -->
                          </div>
                          <div class="form-check" id="fAdicional1">
                            <label class="form-check-label" for="exampleCheck1">Opcional:</label>
                          </div>
                          <div class="form-check" id="fAdicional1">
                            <input type="checkbox" class="form-check-input" id="CheckAdicional1">
                            <label class="form-check-label" for="exampleCheck1">Planchado</label>
                          </div>
                          <div class="form-check" id="fAdicional2">
                            <input type="checkbox" class="form-check-input" id="CheckAdicional2">
                            <label class="form-check-label" for="exampleCheck2">Preparación de alimentos</label>
                          </div>

                          <div class="form-group col-md-6">
                            <label>
                              <button type="button" class="btn btn-primary" onclick="mostrarOcultar('muestra','bloque1');mostrarOcultar('oculta','bloque2');">Atrás</button>
                            </label>
                          </div>

                          <div class="form-group col-md-6">
                            <label >
                              <button type="button" class="btn btn-primary" onclick="mostrarOcultar('muestra','bloque3');mostrarOcultar('oculta','bloque2');">Siguiente</button>
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

      
            <div class="row" id="bloque3"  style="display: none;">  
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
                          </div>

                          <div class="form-group col-md-6 col-xs-7">
                            <label for="calendar">Fecha</label>
                              <input id="fechaAsig" type="date" name="fechaAsig" disabled class="form-control" value="{{ old('fechaAsig') }}">
                          </div>

                          <div class="form-group  col-md-6 col-xs-5">
                            <label for="inputHoras">Hora +30</label>
                            <input type="time" class="form-control" id="inputHoras" placeholder="--:--">
                          </div>


                          <div class="form-group col-xs-12">
                            <h4>Direccion</h4>
                            <select name="InputDireccion" id="InputDireccion" class="form-control">
                              <option value="">Seleccione...</option>
                              @foreach($inmuebles as $inmueble)
                                <option value="{{ $inmueble->INM_IDINMUEBLE }}">{{ $inmueble->INM_DIRECCION }}</option>
                              @endforeach
                            </select>
                          </div>

                          <div class="form-group">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="rdotradir" value="1">
                            <label class="form-control" for="rdotradir">

                              Otra dirección
                            </label>
                          </div>
                          <div class="form-group col-xs-12">
                            <h4>otra dirección</h4>
                          </div>

                          <div class="form-group col-md-6">
                            <label >
                              <button type="button" class="btn btn-primary"  onclick="mostrarOcultar('muestra','bloque2');mostrarOcultar('oculta','bloque3');">Atrás</button>
                            </label>
                          </div>

                          <div class="form-group col-md-6">
                            <label >
                              <button type="button" class="btn btn-primary"  onclick="mostrarOcultar('muestra','bloque4');mostrarOcultar('oculta','bloque3');">Siguiente</button>
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

            <div class="row" id="bloque4"  style="display: none;">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                  </div>
                  <div class="box-body">
                      
                    @foreach($profesionales as $profesional)
                    <div class="row" >
                      <div class="col-xs-1 col-sm-1"></div>
                      <div class="col-xs-10 col-sm-10" >
                        <div class="thumbnail">
                          <img src="{{ asset ($profesional->USR_foto)}}" alt="...">
                          <div class="caption">
                            <h3>{{$profesional->name}} {{$profesional->USR_APELLIDOS}}</h3>
                            <p>
                              <a class="btn btn-default" onclick="ClientGuardaOrden({{$profesional->id}})" role="button">Seleccionar</a>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-3 col-md-3"></div>
                    </div>
                    @endforeach

                    <div class="col-xs-1 col-md-1"></div>
                    <div class="form-group col-xs-4">
                      <label>
                        <button type="button" class="btn btn-primary">Atrás</button>
                      </label>
                    </div>

										<div class="col-md-12" style="margin-top:30px">
											<input type="submit" name="guardarOrden" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear Orden">
												<a href="{{ url('orden') }}">
													<button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Personal">Cancelar</button>
												</a>
										</div>  
                    <div class="col-sm-3 col-xs-4"></div>
                  </div>
                  <div class="box-footer">
                  </div>   
                </div>
              </div>
            </div>

            <div class="row" id="bloque5" style="display: none;">  
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header with-border">
                  </div>
                  <div class="box-body">

                  	<!-- codigo para el ultimo bloque -->

                  </div>
                  <div class="box-footer">
                  </div><!-- footer -->
                </div><!-- box -->
              </div><!-- col -->
            </div>

          </div><!-- fin del thumbnail -->
        </div>

      </div>

    </div> <!-- fin del container -->
  </form>

<script src="{{ asset('js/fullCalendarv4.js') }}"></script>

@endif
@endsection