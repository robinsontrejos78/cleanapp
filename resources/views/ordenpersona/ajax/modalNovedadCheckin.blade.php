<div class="row">
  <form method="post" class="deshabilita" id="formulario" enctype="multipart/form-data" files="true">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
    <input type="hidden" name="i_idor" value="{{$i_idOrden}}" id="i_idor">
    <input type="hidden" name="data" value="" id="data">
            
      <div class="col-md-12">
      <div class="informacion"></div>
        <label for="tipoNovedad">Tipo de Novedad</label>
        <select name="tipoNovedad" id="tipoNovedad" class="form-control">
          <option value="1">Faltante</option>
          <option value="2">Reparación</option>
          <option value="3">Cambio</option>
        </select>
      </div>
      
      <div class="col-md-12">
        <label for="imagen">Evidencia: </label>
        <input type="file" accept="image/*" id="BSbtninfo" name="imagen" capture="camera" class="imagen">
      </div>
      
      <div class="col-md-12">
        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="descripcion" rows="3" style="width:100%; resize:none"></textarea>
      </div>

      <div class="col-md-6" style="margin-top:20px">
        <button type="button" class="btn btn-primary btn-sm btn-block guardarNovedad" data-id="{{$i_idOrden}}">Guardar Evidencia</button>
      </div>

      <div class="col-md-6" style="margin-top:20px">
        <button type="button" class="btn btn-danger btn-sm btn-block" data-dismiss="modal">Cerrar</button>
      </div>
      <div class="col-md-12">
          <center><img  id="preview" class="" style="margin-top:20px"></center>
        </div>
  </form>
</div>

<script>
var data_Imagen;
  $('#BSbtninfo').filestyle({
      iconName : 'glyphicon glyphicon-circle-arrow-up',
      buttonName : 'btn-danger',
      buttonText : ' Tomar foto'
  });

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
    // console.log(myFile);
    function blobToFile(theBlob, fileName){
        var b = theBlob;
        //A Blob() is almost a File() - it's just missing the two properties below which we will add
        b.name = fileName;
        b.idor = document.getElementById('i_idor').value;
        b.lastModifiedDate = new Date();

        return b;
    }

        var idor = $('#i_idor').val();
            
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
</script>