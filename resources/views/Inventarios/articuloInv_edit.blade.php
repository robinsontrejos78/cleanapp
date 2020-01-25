<div class="col-xs-12">
	<div class="box box-danger">

    	<div class="box-header with-border">
    		<h3 class="box-title">Modificar Artículo</h3>
    	</div>

    	<div class="box-body">
    		<form action="{{ url('articuloInv_update/'.$id.'/'.$idProp.'/'.$idInm) }}" action="POST">
    			<input type="hidden" name="_method" value="PUT">
    			<input type="hidden" name="_token" value="{{ csrf_token() }}">
    			<div class="col-md-12">
    				<h4>Cantidad</h4>
    				<input type="text" class="form-control" placeholder="Cantidad de Articulos" name="cantidad" value="{{ $inventario->INV_CANTIDAD }}">
    			</div>
    			<div class="col-md-12">
    				<br>
    				<button class="btn btn-danger btn-flat pull-left">Guardar</button>
    			</div>
    		</form>
    	</div>

  	</div>
</div>