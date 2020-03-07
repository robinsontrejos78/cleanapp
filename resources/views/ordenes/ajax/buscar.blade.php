<thead>
    <tr>
        
        <th class="centro">Estado</th>
        <th class="centro">Documento</th>
        <th class="centro">Dirección</th>
        <th class="centro">Fecha</th>
        <th class="centro">Duración</th>
        <th class="centro">Asignado a</th>
        <th class="centro">Costo</th>
        <th class="centro">Acciones</th>
    </tr>
</thead>
<tbody>
    @foreach($busquedaOrden as $orden)
        <tr class="temporal">
            
            <td>{{ $orden->estado_orden }}</td>
            <td>{{ $orden->USR_DOCUMENTO }}</td>
            <td>{{ $orden->ORD_INM_IDINMUEBLE }}</td>
            <td>{{ date_format(new DateTime($orden->ORD_FECHAORDEN), 'Y-m-d / h:i') }}</td>
            <td>
                <?php 
                  $start_date = new DateTime($orden->ORD_INICIOORDEN);
                  $since_start = $start_date->diff(new DateTime($orden->ORD_FINORDEN));
                  echo $since_start->h.' H '.$since_start->i.' M ';
                ?>
            </td>
            <td>{{ $orden->name }} {{ $orden->USR_APELLIDOS }}</td>
            <td>{{ $orden->ORD_COSTO }}</td>
           
            <td class="centro">
                @if(!$orden->ORD_PAGADO && $orden->ORD_LOO_ESTADOORDEN != 4)
                    @if($orden->estado_orden != "FINALIZADO")
                        @if($orden->estado_orden == "ESPERADOREQUERIMIENTOS")
                            <a class="btn btn-primary btn-sm borrar" href="orden/{{ $orden->ORD_IDORDEN }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar Orden de Servicio" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
                        @endif
                        
                            <button class="btn btn-danger btn-sm anularOrden borrar" data-id="{{ $orden->ORD_IDORDEN }}" data-email="{{ $orden->email }}" data-nombre="{{ $orden->name }} {{ $orden->USR_APELLIDOS }}" data-dir="{{ $orden->ORD_INM_IDINMUEBLE }}" data-toggle="tooltip" data-placement="top" data-original-title="Anular la Orden de Servicio"><span class="glyphicon glyphicon-remove"></span></button>
                    @endif
                @endif
                @if($orden->ORD_LOO_ESTADOORDEN == 4)
                    <span class="badge bg-red quitar" data-toggle="tooltip" data-placement="top" data-original-title="Orden de servidio fue anulada"> Anulado </span> 
                @endif
               
            </td>
        </tr>
    @endforeach
</tbody>

ORD_LOO_ESTADOORDEN