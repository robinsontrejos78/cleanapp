<thead>
  <tr>
    <th class="centro">Nombre y Apellido</th>
    <th class="centro">Empresa</th>
    <th class="centro">Correo Electrónico</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Estado</th>
    <th class="centro">Acciones</th>
  </tr>
</thead>
<tbody>
  @foreach($busquedaUsu as $user)
    @if($user->USR_ESTADO)
    <tr data-id="{{ $user->id }}">
    @else
    <tr data-id="{{ $user->id }}" class="changeEstate">
    @endif
      <td>{{ $user->name }} {{ $user->USR_APELLIDOS }}</td>
      <td>{{ $user->EMP_NOMBRE }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ $user->USR_TELEFONO }}</td>
      <td class="centro">
            <meta name="_token" content="{{ csrf_token() }}"/>

            <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $user->USR_ESTADO }}" @if($user->USR_ESTADO) checked @endif >

            <div class="slider round" title="Cambiar Estado" data-toggle="tooltip" data-placement="top"></div>
      </td>
      <td class="centro">
        <a class="btn btn-info btn-sm consultarUsu" data-table="Usuario" data-id="{{ $user->id }}" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Ver Detalles" data-container="body"><span class="glyphicon glyphicon-search"></span></a>
        <a class="btn btn-primary btn-sm" href="user/{{ $user->id }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
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