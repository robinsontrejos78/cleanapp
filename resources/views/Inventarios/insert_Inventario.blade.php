<table class="table table-bordered table-hover table-striped" data-ruta="../../estado_articuloInv">
  <thead>
    <tr>
      <th>Nombre Artículo</th>
      <th class="centro">Cantidad</th>
      <th class="centro">Estado</th>
      <th class="centro">Acciones</th>
    </tr>
  </thead>
  <tbody>
  @foreach($inventarios as $inventario)
    @if($inventario->INV_ESTADO)
    <tr data-id="{{ $inventario->INV_IDINVENTARIO }}">
    @else
    <tr data-id="{{ $inventario->INV_IDINVENTARIO }}" class="changeEstate">
    @endif
      <td>{{$inventario->ART_NOMBRE}}</td>
      <td class="centro">{{$inventario->INV_CANTIDAD}}</td>
      <td class="centro">
        <input class="checkIcon1" data-group-cls="btn-group-sm" type="checkbox" @if($inventario->INV_ESTADO == 1) checked @endif >
      </td>
      <td class="centro">
        <a class="btn btn-danger btn-sm btn_modal2" data-idInm="{{ $idInm }}" data-idProp="{{ $id }}" data-id="{{ $inventario->INV_IDINVENTARIO }}" role="button" data-toggle="tooltip" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
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