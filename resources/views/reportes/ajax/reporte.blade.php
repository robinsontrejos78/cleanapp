<div class="table-responsive">
<thead>
  <tr>
    <th class="centro">Ciudad</th>
    <th class="centro">Propiedad</th>
    <th class="centro">Cantidad Artículos</th>
    <th class="centro">Total Unidades</th>
  </tr>
</thead>
<tbody>
  
    @foreach($totales as $tota)
     
        <td class="centro">{{ $tota->CIU_NOMBRE }}</td>
        <td class="centro">{{ $tota->PRO_NOMBRE }}</td>
        <td class="centro">{{ $tota->cantidad }}</td>
        <td class="centro">{{ $tota->unidades }}</td>
      </tr>
    @endforeach
</tbody>

<thead>
  <tr>
    <th class="centro"></th>
    <th class="centro"></th>
    <th class="centro"></th>
    <th class="centro"></th>
  </tr>
</thead>
<tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
</tbody>
<thead>
  <tr>
    <th class="centro"></th>
    <th class="centro"></th>
    <th class="centro"></th>
    <th class="centro"></th>
  </tr>
</thead>
<tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
</tbody>
</div>
<thead>
  <tr>
    <th class="centro">Ciudad</th>
    <th class="centro">Propiedad</th>
    <th class="centro">Artículo</th>
    <th class="centro">Cantidad</th>
    <th class="centro">Dirección</th>
  </tr>
</thead>
<tbody>
  
    @foreach($resultados as $res)
     
        <td>{{ $res->CIU_NOMBRE }}</td>
        <td>{{ $res->PRO_NOMBRE }}</td>
        <td>{{ $res->ART_NOMBRE }}</td>
        <td>{{ $res->INV_CANTIDAD }}</td>
        <td>{{ $res->INM_DIRECCION }} </td>
      </tr>
    @endforeach
</tbody>

