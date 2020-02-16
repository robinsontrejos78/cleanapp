@extends('layouts.app')

@section('main-content')

<section class="content-header" style="margin-bottom:30px">
    <h1>Solicitar servicio<small>Cliente</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url ('home') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
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
		    <label for="exampleFormControlInput1">Email address</label>
		    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
		  </div>

		  <div class="form-group">
		    <label for="dir">Seleccione la dirección</label>
		    <select class="form-control" id="dirlist">
		      <option value="13">Calle Barcelona No 203 apto 201</option>
		      <option value="15">1951 NW South River Dr #603</option>
		      <option value="17">Cl 72 No. 23 - 30 apto 301</option>
		    </select>
		  </div>

		  <div class="form-group">
		    <label for="exampleFormControlSelect2">Example multiple select</label>
		    <select multiple class="form-control" id="exampleFormControlSelect2">
		      <option>1</option>
		      <option>2</option>
		      <option>3</option>
		      <option>4</option>
		      <option>5</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Example textarea</label>
		    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
		  </div>
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

<script>

	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var calendar = new FullCalendar.Calendar(calendarEl, {
			plugins: ['dayGrid', 'interaction','timeGrid','list'],
			// defaultView:'timeGridDay'
			header:{
				left: 'MiBoton',
				center:'title',
				right:'timeGridDay, prev, next'
			},
			customButtons:{
				MiBoton:{
					text:'Boton',
					click:function(){
						
					}
				}
			},
			eventClick:function(info){
				console.log(info.event.title);
				console.log(info.event.start);
				console.log(info.event.extendedProps.descripcion);

			},
			dateClick:function(info){
				$('#ModalOrdenservicio').modal('toggle');
				calendar.addEvent({ title:"Evento x", date:info.dateStr });
			},
			events:[
			{
				title:"Mi evento 1",
				start: "2020-02-16 12:30:00",
				descripcion: "la descripcion"
			},
			{
				title:"Mi evento 2",
				start: "2020-02-16 12:30:00"
			}]
		});
		calendar.setOption('locale','Es');

		calendar.render();
	});

</script>

@endsection