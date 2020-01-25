<thead>
  <tr>
    <th class="centro">Propiedad</th>
    <th class="centro">Inmueble</th>
    <th class="centro">Artículo</th>
    <th class="centro">Cantidad</th>
    <th class="centro">Modificar</th>
  </tr>
</thead>
<tbody>
  @foreach($articulo as $art)
   
      <td>{{ $art->PRO_NOMBRE }}</td>
      <td>{{ $art->INM_DIRECCION }}</td>
      <td>{{ $art->ART_NOMBRE }}</td>
      <td>{{ $art->INV_CANTIDAD }}</td>
      <td class="centro">
         <button type="button" class="btn btn-primary btn-sm btn_modal4"  data-idInm="{{ $art->INV_INM_IDINMUEBLE}}" data-idProp="{{ $art->INV_INM_IDINMUEBLE }}" data-id="{{ $art->INV_IDINVENTARIO }}" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></button>
      </td>
    </tr>
  @endforeach
</tbody>

