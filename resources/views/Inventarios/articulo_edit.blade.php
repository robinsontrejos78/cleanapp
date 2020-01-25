<div class="col-xs-12">
	<div class="box box-danger">

    	<div class="box-header with-border">
    		<h3 class="box-title">Modificar Artículo</h3>
    	</div>

    	<div class="box-body">
    		<form action="{{ url('articulo_update/'.$id) }}" action="POST">
    			<input type="hidden" name="_method" value="PUT">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
    			<div class="col-md-12">
    				<h4>Nombre</h4>
    				<input type="text" class="form-control" placeholder="Nombre Articulo" name="nombre" value="{{ $articulo->ART_NOMBRE }}">
    			</div>
    			<div class="col-md-12">
    				<br>
    				<button class="btn btn-danger btn-flat pull-left">Guardar</button>
    			</div>
    		</form>
    	</div>

  	</div>
</div>