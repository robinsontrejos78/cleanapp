<thead>
  <tr>
    <th class="centro">Pais</th>
    <th class="centro">Ciudad</th>
    <th class="centro">Estado</th>
    <th class="centro">Acciones</th>
  </tr>
</thead>
<tbody>
  @foreach($resultados as $ciudad)
    @if($ciudad->CIU_ESTADO)
    <tr data-id="{{ $ciudad->CIU_IDCIUDAD }}">
    @else
    <tr data-id="{{ $ciudad->CIU_IDCIUDAD }}" class="changeEstate">
    @endif
      <td>{{ $ciudad->CIU_NOMBRE}}</td>
      <td>{{ $ciudad->CIU_PAIS }}</td>
    
      <td class="centro">
          <meta name="_token" content="{{ csrf_token() }}"/>

          <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $ciudad->CIU_NOMBRE }}" @if($ciudad->CIU_ESTADO) checked @endif >

          <div class="slider round" title="Cambiar Estado" data-toggle="tooltip" data-placement="top"></div>
      </td>
      <td class="centro">
     
        <a class="btn btn-primary btn-sm" href="ciudad/{{$ciudad->CIU_IDCIUDAD}}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
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