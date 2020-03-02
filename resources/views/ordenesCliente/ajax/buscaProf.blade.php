 
<meta name="_token" content="{{ csrf_token() }}"/>
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
                  <button type="button" class="btn btn-default" onclick="mostrarOcultar('muestra','bloque3');mostrarOcultar('oculta','bloque4');">Atrás</button>
                  <a class="btn btn-primary" onclick="ClientGuardaOrden({{$profesional->id}})" role="button">Seleccionar</a>
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-1 col-md-1"></div>
        </div>
        @endforeach

      </div>
      <div class="box-footer"></div>   
    </div>
  </div>
