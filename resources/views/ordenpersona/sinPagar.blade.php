@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>



<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">

	    <div class="box-header with-border">
	    	<h3 class="box-title">Ordenes pendientes de pago que ya han sido finalizadas</h3>
	    </div>

	    <div class="box-body">
	    	<div class="table-responsive">
		        <table class="table table-striped table-bordered table-hover">
		        	<thead>
		        		<th class="centro">Dirección inmueble</th>
		        		<th class="centro">Inicio</th>
		           		<th class="centro">Fín</th>
		           		<th class="centro">Descripción</th>
		            </thead>
		            <tbody>
		        		@foreach($ordenSin as $ordenS)
		        			<tr>
		        				<td>{{ $ordenS->INM_DIRECCION }}</td>
		        				<td>{{ date_format(new DateTime($ordenS->ORD_INICIOORDEN), 'Y-m-d / H:i') }}</td>
		        				<td>{{ date_format(new DateTime($ordenS->ORD_FINORDEN), 'Y-m-d / H:i') }}</td>
		        				<td>{{ $ordenS->ORD_DESCRIPCION }}</td>
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