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
          <h4 class="modal-title"></h4>
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
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Orden de Servicio {{ $orden->LOO_DESCRIPCION }} - {{ $orden->ORD_INM_IDINMUEBLE }}</h3>
      </div>

     <input type="hidden" id="orden" name="" value="{{  $orden->ORD_IDORDEN }}">
     <input type="hidden" id="cliente" name="" value="{{  $orden->ORD_USR_ID }}">
      
      <div class="box-body">
      <div class="temporal"></div>
      	<div class="row">
      	  <div class="col-md-12">  
      	      <span class="badge bg-yellow btn-block" style="font-size:15px; margin-bottom:20px" data-toggle="tooltip" >Recuerda que el cliente también califica tu servicio</span>
      	  </div>
      	</div>
	      <div class="table-responsive">
			<table class="table table-striped table-bordered table-hover">
	      		<thead>
	      			<th class="centro">Calificar Profesional</th>
	      			<th class="centro">Observación</th>
	      		</thead>
	      		<tbody>
					
						<tr>
			      		<td class="centro"> 
                   <form id="formulario">
                        <p class="clasificacion" >
                          <input id="radio1" type="radio" name="estrellas" value="5">
                          <label for="radio1">★</label>
                          <input id="radio2" type="radio" name="estrellas" value="4">
                          <label for="radio2">★</label>
                          <input id="radio3" type="radio" name="estrellas" value="3">
                          <label for="radio3">★</label>
                          <input id="radio4" type="radio" name="estrellas" value="2">
                          <label for="radio4">★</label>
                          <input id="radio5" type="radio" name="estrellas" value="1">
                         <label for="radio5">★</label>
                       </p>
                   </form>
               </td>
			      			<td class="centro"><input type="text" class="form-control" id="obser"  placeholder="Alguna Novedad?" ></td>
			      			
			      		</tr>
		      	
	      		</tbody>
	      	</table>
	      </div>

	      <div class="col-md-6 col-md-offset-3">
          <button type="button" class="btn btn-primary" id="finalizarOrdenCliente">Finalizar Orden</button>
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