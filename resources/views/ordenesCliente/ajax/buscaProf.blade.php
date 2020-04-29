 
<meta name="_token" content="{{ csrf_token() }}"/>
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <div class="box-body">

        @if(!empty($profesionales))
          @foreach($profesionalesConEstrellas as $profesional)
          <div class="row" >
            <div class="col-xs-1 col-sm-1"></div>
            <div class="col-xs-10 col-sm-10" >
              <div class="thumbnail">
                <img src="{{ asset ($profesional->USR_foto)}}" alt="...">
                <div class="caption">
                  <h3>{{$profesional->name}} {{$profesional->USR_APELLIDOS}}</h3>
                  <p>
                    <div class="info-box">
                      <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">CALIFICACIÓN ESTRELLAS:</span>
                         <span class="info-box-number">{{$profesional->cal_estrellas}}</span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                  </p>
                  <p>
                    <a class="btn btn-default" href="{{ url('/ordenCliente/create') }}">Atrás</a>
                    <button type="button" class="btn btn-primary" id="btnClientGuardaOrden" onclick="ClientGuardaOrden( {{$profesional->id}},'{{$profesional->name}} {{$profesional->USR_APELLIDOS}}')">Seleccionar</button>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-1 col-md-1"></div>
          </div>
          @endforeach
        
        @else
          <div class="row" >
            <div class="col-xs-1 col-sm-1"></div>
            <div class="col-xs-10 col-sm-10" >
              <div class="thumbnail">
                
                <div class="caption">
                  <h3>No hay profesionales disponibles en la fecha hora seleccionada<br>Pulse en el boton Atrás, seleccione fecha hora diferente e intente nuevamente la búsqueda</h3>
                  <p>
                    <a class="btn btn-default" href="{{ url('/ordenCliente/create') }}">Atrás</a>
                    
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-1 col-md-1"></div>
          </div>
        @endif

      </div>
      <div class="box-footer"></div>   
    </div>
  </div>