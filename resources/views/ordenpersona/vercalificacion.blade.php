@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<!--  -->

@if(Session::has('message'))
    <br><br>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        {{Session::get('message')}}
    </div>
@endif
<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tu Promedio es:</span>
               @foreach($contador as $conta)
              <span class="info-box-number">{{ $conta->promedio }}</span>
              @endforeach
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


<div class="row">
  <div class="col-xs-12">
    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title">Calificaciones Otorgadas</h3>

      </div>
        <div class="resultado"></div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoEmp">
            <thead>
                <tr>
                    <th class="centro">Cliente</th>
                    <th class="centro">Estrellas Otorgadas</th>
                    <th class="centro">Observación</th>
                </tr>
            </thead>
            <tbody>
				@foreach($valoraciones as $valoracion)
	          <tr style="text-align:center;">
                <td>{{ $valoracion->name }}{{ $valoracion->USR_APELLIDOS }}</td>
                <td>{{ $valoracion->CAL_CALIFICACION }}</td>
                <td>{{ $valoracion->CAL_OBSERVACION }}</td>   
	              <td class="centro">
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

@endsection