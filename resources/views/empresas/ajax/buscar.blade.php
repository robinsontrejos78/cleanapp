            <thead>
              <tr>
                <th class="centro">Nombre de la Empresa</th>
                <th class="centro">Contacto</th>
                <th class="centro">Teléfono</th>
                <th class="centro">Correo Electrónico</th>
                <th class="centro">Estado</th>
                <th class="centro">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($buscarEmp as $empresa)
                @if($empresa->EMP_ESTADO)
                <tr data-id="{{ $empresa->EMP_IDEMPRESA }}" >
                @else
                <tr data-id="{{ $empresa->EMP_IDEMPRESA }}" class="changeEstate">
                @endif
                  <td>{{ $empresa->EMP_NOMBRE }}</td>
                  <td>{{ $empresa->EMP_CONTACTO }}</td>
                  <td>{{ $empresa->EMP_TELEFONO }}</td>
                  <td>{{ $empresa->EMP_CORREO }}</td>
                  <td class="centro">
                    <meta name="_token" content="{{ csrf_token() }}"/>
                    @if($empresa->EMP_ESTADO) 
                        <input type="checkbox"  class="checkIcon1" data-group-cls="btn-group-sm" name="estado"  value="{{ $empresa->EMP_ESTADO }}" checked>
                    @else
                        <input type="checkbox" class="checkIcon1" data-group-cls="btn-group-sm"  name="estado"  value="{{ $empresa->EMP_ESTADO }}">
                    @endif 
                    <div class="slider round" title="Cambiar Estado" data-toggle="tooltip" data-placement="top"></div>
                  </td>
                  <td class="centro">
                    <a class="btn btn-primary btn-sm" href="empresa/{{ $empresa->EMP_IDEMPRESA }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar" data-container="body"><span class="glyphicon glyphicon-pencil"></span></a>
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