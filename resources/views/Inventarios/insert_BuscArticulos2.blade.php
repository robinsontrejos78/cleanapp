<table class="table table-bordered table-hover table-striped" data-ruta="../estado_articulo">
	<thead>
		<tr>
			<th>Nombre Artículo</th>
			<th class="centro">Estado</th>
			<th class="centro">Acciones</th>
		</tr>
	</thead>
	<tbody>
	@foreach($articulos as $articulo)
		@if($articulo->ART_ESTADO)
		<tr data-id="{{ $articulo->ART_IDARTICULO }}">
		@else
		<tr data-id="{{ $articulo->ART_IDARTICULO }}" class="changeEstate">
		@endif
			<td>{{$articulo->ART_NOMBRE}}</td>
			<td class="centro">
				<input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($articulo->ART_ESTADO == 1) checked @endif >
			</td>
			<td class="centro">
				<a class="btn btn-primary btn-sm btn_modal1" data-table="Articulo" data-show="../edit_" data-id="{{ $articulo->ART_IDARTICULO }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<script>
	$('.checkIcon1').checkboxpicker({
	    html: true,
	    offLabel: '<span class="glyphicon glyphicon-remove">',
	    onLabel: '<span class="glyphicon glyphicon-ok">'
	});
</script>