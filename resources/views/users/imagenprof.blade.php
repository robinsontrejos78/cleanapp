@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

@if(Session::has('message'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-success alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> - {{Session::get('message')}}
      </div>
    </div>
  </div>  
@endif

@if(Session::has('messageE'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-danger alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> - {{Session::get('messageE')}}
      </div>
    </div>
  </div>  
@endif

<div class="informacion"></div>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Cargar Imagen del Profesional <span class="badge bg-teal"  data-toggle="tooltip"  data-container="body"></span></h3>
      </div>


   </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="box box-Primary">

      <div class="box-header with-border">
        <h3 class="box-title">Foto</h3>
      </div>

      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_"  id="artiTable">
  <thead>
    <div class="box-body">
       <div class="col-md-12">
          <label for="imagen">Carga la Imagen desde el Teléfono:</label>
          <input type="file" accept="image/*" id="BSbtninfo" name="imagen" capture="camera" id="img">
        </div>
        <div class="col-md-12" align="center" >
          <button style="margin-top:23px" type="button" id="guardarimagen" class="btn btn-primary" data-toggle="tooltip" title="Guardar" data-container="body">Guardar</button>
        </div>
    </div>         
  </thead>
        </table>
          <div class="col-md-12">
           <center><img  id="preview" class="" style="margin-top:20px"></center>
           </div>
          </div>
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
        b.lastModifiedDate = new Date();
        return b;
        }

        convertirBlobAData(myFile);
        
        function convertirBlobAData( blob ) {
          var reader = new FileReader();
          reader.onload = function(event){
            var fd = {};
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