
<thead>    
    <tr> 
        <th class="centro">El Promedio es:</th>
               @foreach($contador as $conta)
              <td class="centro">{{ $conta->promedio }}</td>
              @endforeach
   </tr>
   <tr></tr>
    <tr></tr>
    <tr>
        <th class="centro">Calificado por:</th>
        <th class="centro">Estrellas otorgadas</th>
        <th class="centro">Fecha</th>
        <th class="centro">Observación</th>
    </tr>
</thead>
<tbody>
    @foreach($resultados as $res)
        <tr class="temporal">
            <td class="centro">{{ $res->name }} {{ $res->USR_APELLIDOS }}</td>
            <td class="centro">{{ $res->CAL_calificacion }}</td>
            <td class="centro">{{ $res->CAL_fecharegistro }}</td>
            <td class="centro">{{ $res->CAL_observacion }}</td>
        </tr>
    @endforeach
</tbody>