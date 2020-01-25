@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>


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
              <span class="badge bg-yellow btn-block" style="font-size:15px; margin-bottom:20px" data-toggle="tooltip" title="Por favor guarde las evidencias finales antes de dar por terminada la orden">Evidencias Check Out</span>
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
        <input type="hidden" name="ruta" value="checkoutOrden">
        <input type="hidden" name="i_tipo" value="2" id="tipoNovedad">
		<div class="informacion"></div>
        <div class="form-group">

                <label>Elija el Step donde iniciará la orden de servicio</label>
                <select class="form-control select2 select2-  hidden-accessible" name="step" id="step" style="width: 100%;" tabindex="-1" aria-hidden="true">

                @foreach( $inventarioout as $inventarios )
                      <option>{{ $inventarios->LOO_DESCRIPCION }}</option>
                @endforeach

                </select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;"><span class="selection"></span></span>
        </div>

        <div class="col-md-12">
          <label for="imagen">Capturar Imagen:</label>
          <input type="file" accept="image/*" id="BSbtninfo" name="imagen" capture="camera">
        </div>
        <div class="col-md-12">
          <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion" rows="3" style="width:100%; resize:none" placeholder="Agregue una descripción relacionada con la imagen capturada"></textarea>
        </div>
        <div class="col-md-4 col-md-offset-2">
          <button class="btn btn-primary btn-sm btn-block guardarEvidencia" data-id="{{ $orden->ORD_IDORDEN }}" style="margin-top:20px">Evidencias de Checkout</button>
          <!-- <input type="submit" class="btn btn-primary btn-sm btn-block" style="margin-top:20px" value="Evidencias Check Out"> -->
        </div>
        <div class="col-md-4">
          


          <a href="../finalizarOrden/{{ $orden->ORD_IDORDEN }}"  class="btn btn-danger btn-sm btn-block finished" style="margin-top:20px"> Finalizar Orden</a> 
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