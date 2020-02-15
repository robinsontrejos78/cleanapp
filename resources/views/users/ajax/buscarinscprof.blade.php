<thead>
  <tr>
    <th class="centro">Nombre y Apellido</th>
    <th class="centro">Tipo Documento</th>
    <th class="centro">Número</th>
    <th class="centro">Fecha/Nacimiento</th>
    <th class="centro">Genero</th>
    <th class="centro">Lugar/Nacimiento</th>
    <th class="centro">Ant/Ciudad</th>
    <th class="centro">Estado Civil</th>
    <th class="centro">Dirección</th>
    <th class="centro">Celular</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Correo</th>
    <th class="centro">Nivel/Estudios</th>
    <th class="centro">Personas/Cargo</th>
    <th class="centro">Conyugue</th>
    <th class="centro">Tipo Documento</th>
    <th class="centro">Número</th>
    <th class="centro">Ref/ Familiar</th>
    <th class="centro">Parentesco</th>
    <th class="centro">Ciudad</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Ref/ Comercial/Personal</th>
    <th class="centro">Parentesco</th>
    <th class="centro">Ciudad</th>
    <th class="centro">Teléfono</th>
    <th class="centro">Acciones</th>
  </tr>
</thead>
<tbody>
  @foreach($resultados as $res)
    @if($res->id)
    <tr data-id="{{ $res->id }}">
    @else
    <tr data-id="{{ $res->id }}" class="changeEstate">
    @endif
      <td>{{ $res->PRO_nombresprof }} {{ $res->PRO_apellidosprof }}</td>
      <td>{{ $res->PRO_tipodocprof }}</td>
      <td>{{ $res->PRO_numdocprof }}</td>
      <td>{{ $res->PRO_fnaciprof }}</td>
      <td>{{ $res->PRO_generoprof }}</td>
      <td>{{ $res->PRO_lugarnacprof }}</td>
      <td>{{ $res->PRO_antigprof }}</td>
      <td>{{ $res->PRO_estcivilprof }}</td>
      <td>{{ $res->PRO_dirprof }}</td>
      <td>{{ $res->PRO_telprof }}</td>
      <td>{{ $res->PRO_telresprof }}</td>
      <td>{{ $res->PRO_mailprof }}</td>
      <td>{{ $res->PRO_nivelprof }}</td>
      <td>{{ $res->PRO_percarprof }}</td>
      <td>{{ $res->PRO_nomcon }} {{ $res->PRO_apecon }}</td>
      <td>{{ $res->PRO_tipodoccon }}</td>
      <td>{{ $res->PRO_numerodoccon }}</td>
      <td>{{ $res->PRO_nombrefa }} {{ $res->PRO_aperefa }}</td>
      <td>{{ $res->PRO_parentrefa }}</td>
      <td>{{ $res->PRO_citirefa }}</td>
      <td>{{ $res->PRO_telrefa }}</td>
      <td>{{ $res->PRO_nomrefcoma }} {{ $res->PRO_aperefcoma }}</td>
      <td>{{ $res->PRO_parentrefcoma }}</td>
      <td>{{ $res->PRO_citicoma }}</td>
      <td>{{ $res->PRO_telrefcoma }}</td>
      <td class="centro">
      <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $res->PRO_estado }}" @if($res->PRO_estado) checked @endif >
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