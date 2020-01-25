@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>



<!-- Ventana modal para agregar novedades CheckIn-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Agregar Novedad</h4>
        </div>
        <div class="modal-body">   
          <div id="agregarNovedad">
          	
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</div>

@if(Session::has('message'))
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		    <div class="alert alert-success alert-dismissible" role="alert">
		        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
		        {{Session::get('message')}}
		    </div>
		</div>    
	</div>
@endif

@if(Session::has('messageE'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
            {{Session::get('messageE')}}
        </div>
    </div>    
  </div>
@endif
@if($tipo == 1)

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Orden de Servicio {{ $orden->LOO_DESCRIPCION }} - {{ $orden->INM_DIRECCION }}</h3>
      </div>

      <div class="box-body">
      <div class="temporal"></div>
      	<div class="row">
      	  <div class="col-md-12">  
      	      <span class="badge bg-yellow btn-block" style="font-size:15px; margin-bottom:20px" data-toggle="tooltip" title="Por favor guarde las evidencias suficientes del servicio que está realizando">Revisar Inventario</span>
      	  </div>
      	</div>
	      <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
	      		<thead>
	      			<th class="centro">Artículo</th>
	      			<th class="centro">Cantidad</th>
	      			<th class="centro">Validar</th>
	      		</thead>
	      		<tbody>
					@foreach($inventarios as $inventario)
						<tr>
			      			<td>{{ $inventario->ART_NOMBRE }}</td>
			      			<td>{{ $inventario->INV_CANTIDAD }}</td>
			      			<td class="centro">
			      				<label class="btn btn-success btn-xs">
			      				    <input type="radio" name="options{{$inventario->INV_IDINVENTARIO}}" id="bien" autocomplete="off" checked> Bién
			      				</label>
			      				<label class="btn btn-danger btn-xs">
			      				    <input type="radio" name="options{{$inventario->INV_IDINVENTARIO}}" data-idorden="{{$orden->ORD_IDORDEN}}" id="novedad" autocomplete="off"> Novedad
			      				</label>
			      			</td>
			      		</tr>
		      		@endforeach
	      		</tbody>
	      	</table>
	      </div>

	      <div class="col-md-6 col-md-offset-3">
	      	<a href="../continuarOrden/{{$orden->ORD_IDORDEN}}" class="btn btn-success btn-sm btn-block">Continuar Orden de Servicio</a>
	      </div>
      </div>

      <div class="box-footer">
       	
      </div>
           
    </div>
  </div>
</div>

@endif

@if($tipo == 2 || $tipo == 3)
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Orden de Servicio {{ $orden->LOO_DESCRIPCION }} - {{ $orden->INM_DIRECCION }}</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
      	<div class="row">
      	  <div class="col-md-12">  
      	      <span class="badge bg-yellow btn-block" style="font-size:15px; margin-bottom:20px" data-toggle="tooltip" title="Por favor guarde las evidencias suficientes del servicio que está realizando">Evidencias {{ $orden->LOO_DESCRIPCION }}</span>
      	  </div>
      	</div>
        <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
				<tr>
				    <th>Propiedad</th>
				    <td>{{ $orden->PRO_NOMBRE }}</td>
				</tr>
				<tr>
				    <th>Dirección</th>
				    <td>{{ $orden->INM_DIRECCION }}</td>
				</tr>
				<tr>
				    <th>Descripción</th>
				    <td>{{ $orden->ORD_DESCRIPCION }}</td>
				</tr>
			</table>
		</div>
	    <!-- <form method="post" action="" enctype="multipart/form-data" files="true" class="deshabilita"> -->
	   		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	    	<input type="hidden" name="idorden" value="{{ $orden->ORD_IDORDEN }}">
	    	<input type="hidden" name="idor" value="{{ $orden->ORD_IDORDEN }}" id="idor">
	    	<input type="hidden" name="ruta" value="comenzarOrden">
        	<input type="hidden" name="tipo" value="@if($tipo == 2) 3 @endif @if($tipo == 3) 4 @endif" id="tipoNovedad">
	    	<div class="col-md-12">
	    		<label for="imagen">Capturar Imagen:</label>
	    		<input type="file" accept="image/*" id="BSbtninfo" name="imagen" capture="camera">
	    	</div>
	    	<div class="col-md-12">
	    		<label for="descripcion">Descripción: </label>
				<textarea name="descripcion" id="descripcion" rows="3" style="width:100%; resize:none" placeholder="Agregue una descripción relacionada con la imagen capturada"></textarea>
	    	</div>
	    	<div class="col-md-4 col-md-offset-2">
          		<button class="btn btn-primary btn-sm btn-block guardarEvidencia" data-id="{{ $orden->ORD_IDORDEN }}" style="margin-top:20px">Evidencias de Aseo</button>
	    		
	    		<!-- <input type="submit" class="btn btn-primary btn-sm btn-block" style="margin-top:20px" value="Guardar Evidencia"> -->
	    	</div>
	    	<div class="col-md-4">
	    		<a href="../finalizarOrden/{{ $orden->ORD_IDORDEN }}" class="btn btn-danger btn-sm btn-block" style="margin-top:20px">Finalizar Orden</a>
	    	</div>
	    <!-- </form> -->
	    <div class="col-md-12">
	      <center><img  id="preview" class="" style="margin-top:20px"></center>
	    </div>    
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>
@endif

@endsection

<script>
var data_Imagen;

window.onload = function (){
  document.getElementById('BSbtninfo').onchange = function(evt) {
    
    try {
        nombre = this.files[0].name;
    }
    catch(err) {
        document.getElementById('preview').removeAttribute("src");
        data_Imagen = null;
        return;
    }

    nombre = this.files[0].name;
    ImageTools.resize(this.files[0], {
        width: 320, // maximum width
        height: 240 // maximum height
    }, function(blob, didItResize) {
        // didItResize will be true if it managed to resize it, otherwise false (and will return the original file as 'blob')
        document.getElementById('preview').src = window.URL.createObjectURL(blob);
        // you can also now upload this blob using an XHR.
    
        var myFile = blobToFile(blob, nombre);
        
        function blobToFile(theBlob, fileName){
        var b = theBlob;
        //A Blob() is almost a File() - it's just missing the two properties below which we will add
        b.name = fileName;
        b.idor = $('#idor').val();
        b.lastModifiedDate = new Date();

        return b;
        }

        var idor = $('#idor').val();
        convertirBlobAData(myFile);
        
        function convertirBlobAData( blob ) {
          var reader = new FileReader();
          reader.onload = function(event){
            var fd = {};
            fd["idor"]  = idor;
            fd["fname"] = nombre;
            fd["data"]  = event.target.result;
            data_Imagen = fd;
          };

          reader.readAsDataURL(blob);
        }
    });

  };
}
</script>