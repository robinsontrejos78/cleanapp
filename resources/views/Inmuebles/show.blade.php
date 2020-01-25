<tr>
    <th>Propiedad</th>
    <td>{{ $inmueble->PRO_NOMBRE}}</td>
</tr>
<tr>
    <th>Tipo de Inmueble</th>
    <td>{{ $inmueble->LOO_DESCRIPCION}}</td>
</tr>
<tr>
    <th>Direccion</th>
    <td>{{ $inmueble->INM_DIRECCION }}</td>
</tr>
<tr>
    <th>Nombre Contacto</th>
    <td>{{ $inmueble->INM_PROPIETARIO }}</td>
</tr>
<tr>
    <th>Telefono COntacto</th>
    <td>{{ $inmueble->INM_TELEFONO }}</td>
</tr>
<tr>
    <th>Email Contacto</th>
    <td>{{ $inmueble->INM_EMAIL }}</td>
</tr>
<tr>
    <th>Estado</th>
    <td>
        @if($inmueble->INM_ESTADO == 1)
            Habilitado
        @else
            Desactivado
        @endif
    </td>
</tr>
<tr>
    <th>Creado Por</th>
    <td>{{ $inmueble->name }}</td>
</tr>
