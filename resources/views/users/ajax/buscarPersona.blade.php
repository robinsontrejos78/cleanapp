<thead>
  <tr>
    <th class="centro">Nombre y Apellido</th>
    <th class="centro">Función</th>
    <th class="centro">Correo Electrónico</th>
    <th class="centro">Teléfono Móvil</th>
    <th class="centro">Estado</th>
    <th class="centro">Acciones</th>
  </tr>
</thead>
<tbody>
  @foreach($busquedaPer as $user)
    @if($user->USR_ESTADO)
    <tr data-id="{{ $user->id }}">
    @else
    <tr data-id="{{ $user->id }}" class="changeEstate">
    @endif
      <td>{{ $user->name }} {{ $user->USR_APELLIDOS }}</td>
      <td>{{ $user->LOO_DESCRIPCION }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->USR_CELULAR }}</td>
      <td class="centro">
        <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $user->USR_ESTADO }}" @if($user->USR_ESTADO) checked @endif >
      </td>
      <td class="centro">
        <a class="btn btn-info btn-sm btn_modal1" data-table="Persona" data-show="show" data-id="{{ $user->id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Ver Detalles"><span class="glyphicon glyphicon-search"></span></a>
        <a class="btn btn-primary btn-sm" href="editPer/{{ $user->id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"><span class="glyphicon glyphicon-pencil"></span></a>
      </td>
    </tr>
  @endforeach
</tbody>

<script>
  $('.checkIcon1').checkboxpicker({
    html: true,
    offLabel: '<span class="glyphicon glyphicon-remove">',
    onLabel: '<span class="glyphicon glyphicon-ok">'
});
</script>