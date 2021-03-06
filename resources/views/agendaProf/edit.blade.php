@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<section class="content-header" style="margin-bottom:30px">
    <h1>Solicitar servicio<small>Cliente</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Solicitar Servicio</li>
    </ol>
</section>

@if (count($errors) > 0)
	<div class="alert alert-danger">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <li>{{ $error }}</li>
	        @endforeach
	    </ul>
	</div>
@endif

<!-- Modal -->
<div class="modal fade" id="ModalOrdenservicio" tabindex="-1" role="dialog" aria-labelledby="ModalOrdenservicioLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalOrdenservicioLabel">Datos del servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form>

		 <div class="form-group">
		 	<label for="dir">Seleccione la dirección</label>
		    <select class="form-control" id="dirlist">
		      <option value="13">Calle Barcelona No 203 apto 201</option>
		      <option value="15">1951 NW South River Dr #603</option>
		      <option value="17">Cl 72 No. 23 - 30 apto 301</option>
		    </select>
		 </div>

		<div class="form-group">
		    <label for="plan">Seleccione el plan</label>
		    <select class="form-control" id="planlist">
		      	<option value="1">PLAN 1 (1 HORA)</option>
		      	<option value="4">PLAN 2 (4 HORAS)</option>
		      	<option value="8">PLAN 3 (8 HORAS)</option>
		    </select>
		</div>

		<div class="form-group">
		    <label for="hora">hora inicial</label>
		    <div class="input-group">
		    	<input type="text" class="form-control timepicker" id="hora" name="hora" placeholder="23:59 24hs">
		    	<div class="input-group-addon">
					<i class="fa fa-clock-o"></i>
				</div>
		    </div>	
		</div>

		  <div class="form-group">
		    <label for="descri">descripcion</label>
		    <textarea class="form-control" id="descri" rows="3"></textarea>
		  </div>

		  <input type="hidden" id="empresa" value="{{ $idempr }}">
		  <input type="hidden" id="usuarioId" value="{{ $usuarioId }}">
		  
		</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnAgregarOrdServ">Agregar</button>
        <button type="button" class="btn btn-warning"  id="btnModificarOrdServ">Modificar</button>
        <button type="button" class="btn btn-danger" id="btnBorrarOrdServ">Borrar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- fin de modal -->


<div class="row">
	<div class="col-md-12">
		<div class="box box-danger">
			<div class="box-header with-border">
				<h3 class="box-title">Solicitar Servicio</h3>
			</div>
			<div class="box-body">
				<div id='calendar' style="max-width:50%; margin:2% auto;"></div>
			</div>
			<div class="box-footer">
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/fullcalendar4.js') }}"></script>


@endsection