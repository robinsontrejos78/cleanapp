 
<meta name="_token" content="{{ csrf_token() }}"/>
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header with-border">
      </div>
      <div class="box-body">

        @if(!empty($profesionales))
          @foreach($profesionales as $profesional)
          <div class="row" >
            <div class="col-xs-1 col-sm-1"></div>
            <div class="col-xs-10 col-sm-10" >
              <div class="thumbnail">
                <img src="{{ asset ($profesional->USR_foto)}}" alt="...">
                <div class="caption">
                  <h3>{{$profesional->name}} {{$profesional->USR_APELLIDOS}}</h3>
                  <input type="hidden" value="{{$profesional->name}} {{$profesional->USR_APELLIDOS}}" id="nomprof">
                  <p>
                    <a class="btn btn-default" href="{{ url('/ordenCliente/create') }}">Atrás</a>
                    <a class="btn btn-primary" onclick="ClientGuardaOrden({{$profesional->id}})" role="button">Seleccionar</a>
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
