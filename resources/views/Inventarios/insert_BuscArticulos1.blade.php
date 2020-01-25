<div class="col-md-12">
  <div class="box box-danger">

    <div class="box-header with-border">
      <h3 class="box-title">Asignar Artículos</h3>
    </div>

    <div class="box-body">
      <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped" data-ruta="">
        <thead>
          <tr>
            <th>Nombre Artículo</th>
            <th class="centro">Cantidad</th>
            <th class="centro">Acciones</th>
          </tr>
        </thead>
        <tbody>
        @foreach($articulos as $articulo)
          @if($articulo->ART_IDARTICULO == $articulo->INV_ART_IDARTICULO && $articulo->INV_INM_IDINMUEBLE == $idInm)

          @else
          <tr>
            <td>{{$articulo->ART_NOMBRE}}</td>
            <td><input type="number" class="form-control cantidad_Art"></td>
            <td class="centro">
              <a class="btn btn-danger btn-sm btn_agregarArt" data-id="{{ $articulo->ART_IDARTICULO }}" data-toggle="tooltip" data-placement="top" data-original-title="Agregar"><span class="glyphicon glyphicon-plus"></span></a>
            </td>
          </tr>
          @endif
        @endforeach
        </tbody>
      </table>
    </div>
    </div>

    <div class="box-footer">
      
    </div>
         
  </div>
</div>