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

<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Solicitar Servicio</h3>
      </div>

      <div class="box-body">
      	<div id='calendar'></div>
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
			// plugins: ['dayGrid']
			plugins: ['dayGrid', 'timeGrid']
		});

		calendar.render();
	});

</script>

@endsection