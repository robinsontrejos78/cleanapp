/////////////////////////////variables globales

var valPlansel='0';
var horasplan='0';


//Buscador de empresas Módulo SuperAdmin
$(document).on('click', '#buscarEmp', function(){
    var s_nombreEmpresa     = $('#nombreEmp').val();
    var s_nombreContacto    = $('#nombreCon').val();
    var s_correoElectronico = $('#correoElec').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarEmp',
        data : {s_nombreEmpresa : s_nombreEmpresa, s_nombreContacto : s_nombreContacto, s_correoElectronico : s_correoElectronico},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $("table").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

//Buscador de ciudades_________________________________________________________________________________________________________________________
$(document).on('click', '#buscarCiu', function(){
    var s_nombreCiudad = $('#nombreCiu').val();
    var s_nombrePais   = $('#nombrePais').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarCiu',
        data : {s_nombreCiudad : s_nombreCiudad, s_nombrePais : s_nombrePais},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $("table").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});



//Buscador de ciudades_________________________________________________________________________________________________________________________
$(document).on('click', '#buscarcalprof', function(){
    var nombreUsu   = $('#nombreUsu').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'mostrarcalprof',
        data : {nombreUsu : nombreUsu},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $("table").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

//Buscador de calificaciones de clientes_________________________________________________________________________________________________________________________
$(document).on('click', '#buscarcalcli', function(){
    var nombreUsucli = $('#nombreUsucli').val();
    // var docucli      = $('#docucli').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'mostrarcalcli',
        data : {nombreUsucli : nombreUsucli},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $("table").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

//Buscador de Usuarios Módulo SuperAdmin-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#buscarUsu', function(){
    var s_nombreUsuario     = $('#nombreUsu').val();
    var s_apellidoUsuario   = $('#apellidoUsu').val();
    var s_correoElectronico = $('#correoElec').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarUsu',
        data : {s_nombreUsuario : s_nombreUsuario, s_apellidoUsuario : s_apellidoUsuario, s_correoElectronico : s_correoElectronico},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

// Cambiar estados---------------------------------------------------------------------------------------------------------------------------------
$(document).on('change', '.checkIcon1', function() {

    var s_elm = $(this);
    var row   = s_elm.parents('tr');
    var id    = row.data('id');
    var tipo  = s_elm.parents("table").data("ruta");
    s_elm.val(s_elm.is(':checked') ? 1 : 0);
    
    row.toggleClass('changeEstate');

    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    $.post(tipo, {id:id, estado:s_elm.val()}, function() {
 
    });

});


//ventana modal de las imagenes de las novedades en el index de administrador---------------------------------------------------------------------

$(document).on('click', '.modalimagen', function(){

    $("#imagenmodal").modal("hide");
    $("#imagenmodal").modal("show");

    var id = $(this).attr('data-id');

    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    $.post('imagenNovedad', {id : id}, function(data){
        $('.insertarimagen').html(data);
    });
});


//ventana modal consultar Usuarios-----------------------------------------------------------
$(document).on('click', '.btn_modal', function(event) {

        $("#myModal").modal("hide");


        var table = $(this).attr('data-table');
        var show  = $(this).attr('data-show');

        event.preventDefault();

        $("#consultar" + table).html("");
        $("#myModal").modal("show");

        id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
       
        $.get('show/'+ id, function(data) {
            $("#consultarUsuario").html(data);
        });
});

//ventana modal consultar Personas---------------------------------------------------------
$(document).on('click', '.btn_modal3', function(event) {

        $("#myModal").modal("hide");


        var table = $(this).attr('data-table');
        var show  = $(this).attr('data-show');

        event.preventDefault();

        $("#consultar" + table).html("");
        $("#myModal").modal("show");

        id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
       
        $.get('showPersona/'+ id, function(data) {
            $("#consultarPersona").html(data);
        });
});

//ventana modal--------------------------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.btn_modal1', function(event) {

        $("#myModal").modal("hide");

        var table = $(this).attr('data-table');
        var show  = $(this).attr('data-show');

        $("#consultar" + table).html("");
        $("#myModal").modal("show");

        id = $(this).attr('data-id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
       
        $.get('../../edit_Articulo/' +show + table + '/' + id, function(data) {
            $("#consultarArticulo").html(data);
        });
});

//Registrar datos del formulario para solicitud del profesional--------------------------------------------------------------------------------------------------------
$(document).on('click', '#inscripcion', function(){
    
    var nombresprof   = $('#nombresprof').val();
    var apellidosprof = $('#apellidosprof').val();
    var tipodocprof   = $('#tipodocprof').val();
    var numdocprof    = $('#numdocprof').val();
    var fnaciprof     = $('#fnaciprof').val();
    var generoprof    = $('#generoprof').val();
    var lugarnacprof  = $('#lugarnacprof').val();
    var antigprof     = $('#antigprof').val();
    var estcivilprof  = $('#estcivilprof').val();
    var dirprof       = $('#dirprof').val();
    var telprof       = $('#telprof').val();
    var telresprof    = $('#telresprof').val();
    var mailprof      = $('#mailprof').val();
    var nivelprof     = $('#nivelprof').val();
    var percarprof    = $('#percarprof').val();
    var planchar      = $('#planchar').val();
    var cocinar       = $('#cocinar').val();
    var nomcon        = $('#nomcon').val();
    var apecon        = $('#apecon').val();
    var tipodoccon    = $('#tipodoccon').val();
    var numerodoccon  = $('#numerodoccon').val();
    var nombrefa      = $('#nombrefa').val();
    var aperefa       = $('#aperefa').val();
    var parentrefa    = $('#parentrefa').val();
    var citirefa      = $('#citirefa').val();
    var telrefa       = $('#telrefa').val();
    var nomrefcoma    = $('#nomrefcoma').val();
    var aperefcoma    = $('#aperefcoma').val();
    var parentrefcoma = $('#parentrefcoma').val();
    var citicoma      = $('#citicoma').val();
    var telrefcoma    = $('#telrefcoma').val();
    var s_terminos    =$('#terminos').is(":checked");
    var s_datos       =$('#datos').is(":checked");
        $('#nombresprof').val("");
        $('#apellidosprof').val("");
        $('#tipodocprof').val("");
        $('#numdocprof').val("");
        $('#fnaciprof').val("");
        $('#generoprof').val("");
        $('#lugarnacprof').val("");
        $('#antigprof').val("");
        $('#estcivilprof').val("");
        $('#dirprof').val("");
        $('#telprof').val("");
        $('#telresprof').val("");
        $('#mailprof').val("");
        $('#nivelprof').val("");
        $('#percarprof').val("");
        $('#planchar').val("");
        $('#cocinar').val("");
        $('#nomcon').val("");
        $('#apecon').val("");
        $('#tipodoccon').val("");
        $('#numerodoccon').val("");
        $('#nombrefa').val("");
        $('#aperefa').val("");
        $('#parentrefa').val("");
        $('#citirefa').val("");
        $('#telrefa').val("");
        $('#nomrefcoma').val("");
        $('#aperefcoma').val("");
        $('#parentrefcoma').val("");
        $('#citicoma').val("");
        $('#telrefcoma').val("");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'inscripcionprof',
        data : {  nombresprof : nombresprof,  apellidosprof : apellidosprof, tipodocprof : tipodocprof,  
                  numdocprof : numdocprof, fnaciprof : fnaciprof, generoprof : generoprof, 
                  lugarnacprof : lugarnacprof, antigprof : antigprof, estcivilprof : estcivilprof, 
                  dirprof : dirprof, telprof : telprof, telresprof : telresprof, mailprof : mailprof,  
                  nivelprof : nivelprof, percarprof : percarprof, nomcon : nomcon, apecon : apecon,   
                  tipodoccon : tipodoccon, numerodoccon : numerodoccon, nombrefa : nombrefa,  
                  aperefa : aperefa, parentrefa : parentrefa, citirefa : citirefa, telrefa : telrefa,  
                  nomrefcoma : nomrefcoma, aperefcoma : aperefcoma, parentrefcoma : parentrefcoma,  
                  citicoma : citicoma, telrefcoma : telrefcoma, s_terminos : s_terminos, s_datos : s_datos, 
                  planchar : planchar, cocinar : cocinar},

        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
        $('.resultado').html('<div class="row"><div class="col-sm-12 col-md-offset-0"><div class="alert alert-success alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 30px;><span>&times;</span></button><span class=".glyphicon .glyphicon-saved" aria-hidden="true"></span><b>Te has registrado con exito!,</b> uno de nuestros agentes te contactará pronto.</div></div></div>');
         },
        error: function(){
        }
    });

});



//Consultar profesionales que se han inscrito en la plataforma
$(document).on('click', '#buscarprof', function(){
    var fechaprof  = $('#fechaprof').val();
    var docuprof   = $('#docuprof').val();
    var nombreprof = $('#nombreprof').val();

        $('#fechaprof').val("");
        $('#docuprof').val("");
        $('#nombreprof').val("");     

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarprof',
        data : {fechaprof : fechaprof, docuprof : docuprof, nombreprof : nombreprof},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});





//ventana modal modificar articulo Inventario--------------------------------------------------------------------------------------------------------
$(document).on('click', '.btn_modal2', function(event) {

        $("#myModal").modal("hide");

        var idInm  = $(this).attr('data-idInm');
        var idProp = $(this).attr('data-idProp');
        var id     = $(this).attr('data-id');

        $("#consultarInventario").html("");
        $("#myModal").modal("show");
       
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.get('../../edit_Inventario/' + id + '/' + idProp + '/' + idInm, function(data) {
            $("#consultarInventario").html(data);
        });
});


//ventana modal modificar articulo Inventario desde el Inventario--------------------------------------------------------------------------------------------------------

$(document).on('click', '.btn_modal4', function(event) {

        $("#editModal").modal("hide");

        var idInm  = $(this).attr('data-idInm');
        var idProp = $(this).attr('data-idProp');
        var id     = $(this).attr('data-id');

        $("#consultarInventario").html("");
        $("#editModal").modal("show");
       
       $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.get('edit_Art/' + id + '/' + idProp + '/' + idInm, function(data) {
            $("#consultarInventario").html(data);
        });
});


//deshabilita submit--------------------------------------------------------------------------------------------------------------------------------
$(document).on('submit', 'form.deshabilita', function(){
    $(this).find('input[type=submit]').prop('disabled', true);
});



//--------------------------------------------------------------------------------------------------------------------------------------------------
$(document).on('focusout', '.docusu', function() {

    var i_docusu = $(this).val();
    
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
    var path = window.location.pathname;

    $.ajax({
            type : 'POST',
            url : 'validaEmpresa',
            data : {i_docusu : i_docusu},
            beforeSend: function(){

            },
            success: function(data){
                $(".busqueda").html(data);
            },
            error: function(data){
                // $(".busqueda").html(data);
            }
        });
});



//Buscador de Persona Módulo Administrador--------------------------------------------------------------------------------------------------------
$(document).on('click', '#busreporte', function(){
    
    var s_busCiu  = $('#busCiu').val();
    var s_busProp = $('#busProp').val();
    var s_busArt  = $('#busArt').val();


      $('#busCiu').val("");
      $('#busProp').val("");
      $('#busArt').val("");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarreporte',
        data : {s_busCiu : s_busCiu, s_busProp : s_busProp, s_busArt : s_busArt},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });

});

//descartar inscripciones de profesionales desde el Módulo Administrador----------------------------------------------------------------------------------------------------------
$(document).on('click', '#descartar', function(){
    
    var data  = $(this).attr('data-id');
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'descartarregistro',
        data : { data : data },
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            swal(data);
             window.location.reload(true);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});


//finalizar la orden de servicio con su respectiva calificación----------------------------------------------------------------------------------------------------------
$(document).on('click', '#finalizar', function(){
    
    var calif     = $('input[name=estrellas]:checked', '#formulario').val();
    var obser     = $('#obser').val();
    var dataord   = $('#orden').val();
    var dataruta  = $('#cliente').val();

    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : '../calificarorden',
        data : { calif : calif, obser : obser, dataord : dataord, dataruta : dataruta},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
          
              window.location.href='../ordenP';
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});



//Buscador de Persona Módulo Administrador--------------------------------------------------------------------------------------------------------
$(document).on('click', '#buscarPer', function(){
    var s_nombreUsuario     = $('#nombreUsu').val();
    var s_apellidoUsuario   = $('#apellidoUsu').val();
    var s_correoElectronico = $('#correoElec').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarPer',
        data : {s_nombreUsuario : s_nombreUsuario, s_apellidoUsuario : s_apellidoUsuario, s_correoElectronico : s_correoElectronico},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });

});


//Buscador de Artículos del inventario--------------------------------------------------------------------------------------------------------
$(document).on('click', '#buscarArti', function(){
    var s_propiedades = $('#propiedades').val();
    var s_articulos   = $('#articulos').val();

 $('#propiedades').val("");
 $('#articulos').val("");


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscararti',
        data : {s_propiedades : s_propiedades, s_articulos : s_articulos},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });

});

//Buscador de Ordenes Módulo Administrador----------------------------------------------------------------------------------------------------------
$(document).on('click', '#buscarOrd', function(){
    var i_nombrePersona     = $('#nombrePer').val();
    var i_documentoPersona  = $('#documentoPer').val();
    var i_estadoOrden       = $('#estadoOrd').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarOrd',
        data : {i_nombrePersona : i_nombrePersona, i_documentoPersona : i_documentoPersona, i_estadoOrden : i_estadoOrden},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

//checbox style------------------------------------------------------------------------------------------------------------------------------------
$('.checkIcon1').checkboxpicker({
    html: true,
    offLabel: '<span class="glyphicon glyphicon-remove">',
    onLabel: '<span class="glyphicon glyphicon-ok">'
});

//llena select en ordenes de servicios con personas dependiendo el tipo (aseo, mantenimiento, inventario)-------------------------------------------
$(document).on('change', '.tipoOrden', function(){
    var i_tipo       = $(this).val();
    var i_idinmueble = $('.inmueble'). val();
    var s_ruta       = $(this).attr('data-ruta');

    if(i_idinmueble == ""){
        $('#vacio').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger alert-dismissible msg" role="alert" style="margin-top:30px"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Debe de seleccionar un inmueble</div></div></div>');
        return;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
    $.post(s_ruta, {i_tipo : i_tipo, i_idinmueble : i_idinmueble} , function(data) {
        $(".tipoPersona").html(data);
    });
});

//Buscador de Articulos _create------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.btn_buscarArt2', function(){
    var nombre_articulo = $('#nombre_articulo').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : '../../buscar_articulo2',
        data : {nombre_articulo : nombre_articulo},
        beforeSend: function(){

            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $('#insert_BuscArticulos2').html(data);
        }
    });
});

//Buscador de Articulos Inventario---------------------------------------------------------------------------------------------------------------
$(document).on('click', '.btn_buscarArt1', function(){
    var nombre_articulo = $('#nombre_articulo').val();
    var idInm           = $('#insert_BuscArticulos1').attr('data-idInm');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : '../../buscar_articulo1',
        data : {nombre_articulo : nombre_articulo, idInm:idInm},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $('#insert_BuscArticulos1').html(data);
        }
    });
});

//agregar articulos al inventario--------------------------------------------------------------------------------------------------------------
$(document).on('click', '.btn_agregarArt', function() {
    var btn          = $(this);
    var idart        = btn.attr('data-id');
    var cantidad_Art = btn.parents('tr').find('.cantidad_Art').val();
    var idInm        = $('#insert_BuscArticulos1').attr('data-idInm');
    var id           = $('#insert_BuscArticulos1').attr('data-idProp');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    btn.parents('tr').remove();

    $.post('../../guardar_inv', {idart:idart, cantidad_Art:cantidad_Art, idInm:idInm, id:id}, function(data) {
        $('#insert_inventario').html(data);
    })
})

//Ruta para pagar orden de servicio(Cancelar orden)------------------------------------------------------------------------------------------
$(document).on('click', '.cancelarOrden', function(){
    var s_nombre  = $(this).attr('data-nombre');
    var s_email   = $(this).attr('data-email');
    var s_direc   = $(this).attr('data-dir');
    var i_costo   = $(this).attr('data-costo');
    var i_idorden = $(this).attr('data-id');
    var e_td      = $(this).parents('td');
    var boton1    = $(this);

    swal({
      title: "Está seguro de pagar esta orden de servicio?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: "Pagar!",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "Cancelar!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        swal("Pagada!", "La Orden ha sido pagada.", "success");
        
         $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
             }
         });

        $.ajax({
            type : 'POST',
            url : 'pagarOrden',
            data : {i_idorden : i_idorden, s_email : s_email, s_nombre : s_nombre, s_direc : s_direc, i_costo : i_costo},
            beforeSend: function(){
                var dim = $('#dimmer');
                dim.css("display", "block");
            },
            complete:function(){
                var dim = $('#dimmer');
                dim.css("display", "none");
            },
            success: function(data){
                boton1.parents('tr').find('.borrar').remove();
                $('.tooltip').remove();
                e_td.html('<span class="badge bg-red" data-toggle="tooltip" title="" data-placement="top" data-original-title="Orden de Pago ya Cancelada"> Cancelado </span>');
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-success alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Pago Generado con exito. Se envió e-mail de confirmación</div></div></div>')
            },
            error: function(){
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Error al generar el pago de la Orden. Contacte al administrador</div></div></div>');
            }
        });
      } else {
        swal("Cancelada", "La orden no ha sido pagada", "error");
      }
    });
});


//vargar y guardar la imgagen del profesional
$(document).on('click', '#guardarimagen', function(){

    $('.msg').remove();
    if(!data_Imagen){
        $('.informacion').html('<div class="col-md-12"><div class="alert alert-danger alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><i class="icon fa fa-warning"> No ha llenado toda la información</div></div>');
        return;        
    }
  
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
    $.ajax({
        type: 'POST',
        url: 'guardarimagen',
        data: data_Imagen,
        dataType: 'text',
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            swal(data);
            $(":file").filestyle('clear');
            $('#preview').removeAttr('src');
            $('#descripcion').val('');
            data_Imagen=null;
        },
        error: function(){
            swal("Error al guardar la Imagen!", "Intente de nuevo!");
        }


    });
    
});






//anular orden de servicio-----------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.anularOrden', function(){
    var s_nombre  = $(this).attr('data-nombre');
    var s_email   = $(this).attr('data-email');
    var s_direc   = $(this).attr('data-dir');
    var i_idorden = $(this).attr('data-id');
    var e_td      = $(this).parents('td');
    var boton1    = $(this);

    swal({
      title: "Está seguro de anular la orden de servicio?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: "Anular!",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "Cancelar!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        swal("Anulada!", "La orden de servicio ha sido anulada.", "success");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url : 'anularOrden',
            data : {i_idorden : i_idorden, s_email : s_email, s_nombre : s_nombre, s_direc : s_direc},
            beforeSend: function(){
                var dim = $('#dimmer');
                dim.css("display", "block");
            },
            complete:function(){
                var dim = $('#dimmer');
                dim.css("display", "none");
            },
            success: function(data){
                boton1.parents('tr').find('.cancelarOrden').remove();
                $('.tooltip').remove();
                e_td.html('<span class="badge bg-red" data-toggle="tooltip" title="" data-placement="top" data-original-title="Orden de Pago Anulada"> Anulado </span>');
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-success alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Orden de Servicio Anulada. Se envió e-mail de confirmación</div></div></div>')
            },
            error: function(){
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Error al Anular la Orden. Contacte al administrador</div></div></div>');
            }
        });
      } else {
        swal("Cancelada", "La orden de servicio no fue anulada", "error");
      }
    });
});

//modal para agregar novedad de checkin-----------------------------------------------------------------------------------------------------------
$(document).on('click', '#novedad', function(){
    
    $("#myModal").modal("hide");
    var i_idOrden      = $(this).attr('data-idorden');
    $("#myModal").modal("show");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.post('../novedadCheckin', {i_idOrden : i_idOrden}, function(data) {
        $('#agregarNovedad').html(data);
    })
});

//guardar novedad desde la ventana modal de checkin-------------------------------------------------------------------------------------------
$(document).on('click', '.guardarNovedad', function(){
    var s_ruta = $('#s_ruta').val();
    var s_desc = $('#descripcion').val();
    var i_tipo = $('#tipoNovedad').val();
    var i_idor = $(this).attr('data-id');
    
    if(s_ruta == "" || s_desc == ""){
        $('.informacion').html('<div class="col-md-12"><div class="alert alert-danger alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><i class="icon fa fa-warning"> No ha llenado toda la información</div></div>');
        return;        
    }
      
        data_Imagen.s_desc = s_desc;
        data_Imagen.i_tipo = i_tipo;
        data_Imagen.i_idor = i_idor;
        data_Imagen.s_ruta = s_ruta;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '../guardarNovedad',
        data: data_Imagen,
        dataType: 'text',
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(){
            $("#myModal").modal("hide");
            swal("Novedad guardada con exito!", "Oprima OK para continuar!", "success")
        },
        error: function(){
            $("#myModal").modal("hide");
            swal("Error al guardar la Novedad!", "Intente de nuevo!", "error")
        }
    });
});



//ventana modal para ver evidencias---------------------------------------------------------------------------------------------------------------
$(document).on('click', '.verImagen', function(){
    
    $('.verImagenesE').html("");
    $("#myModal").modal("hide");
    var s_ruta = $(this).attr('src');
    var s_desc = $(this)[0].dataset.originalTitle;
    $("#myModal").modal("show");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

        $.post('../verImagenEvi', {s_ruta : s_ruta, s_desc : s_desc}, function(data) {
            $('.verImagenesE').html(data);
        });

});

//terminar la novedad------------------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.terminarnovedad', function(){

    var idnovedad = $(this).attr('data-idnov');
    var e_tr      = $(this).parents('tr');
    var i_cont    = $('.contador').html();
    var i_step    = $('#step').val();
    i_cont = i_cont - 1;

    swal({
      title: "Está seguro de finalizar la novedad?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: "Finalizar!",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "Cancelar!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        swal("Finalizada!", "La novedad ha sido revisada", "success");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        e_tr.remove();
        $('.contador').html(i_cont);
        $.ajax({
            type : 'POST',
            url : 'finalizarNovedad',
            data : {idnovedad : idnovedad},
            beforeSend: function(){
                var dim = $('#dimmer');
                dim.css("display", "block");
            },
            complete:function(){
                var dim = $('#dimmer');
                dim.css("display", "none");
            },
            success: function(data){
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-success alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Novedad Finalizada</div></div></div>')
                window.location.reload(true);
            },
            error: function(){
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-danger alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Error al finalizar novedad. Contacte al administrador</div></div></div>');
            }
        });
      } else {
        swal("Cancelada", "La novedad no fue finalizada", "error");
      }
    });
});


//Guardar evidencias de aseo-----------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.guardarEvidencia', function(){
    var s_ruta = $('#s_ruta').val();
    var s_desc = $('#descripcion').val();
    var i_step = $('#step').val();
    var i_tipo = $('#tipoNovedad').val();
    


    $('.msg').remove();
    if(!data_Imagen || s_desc == ""){
        $('.informacion').html('<div class="col-md-12"><div class="alert alert-danger alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><i class="icon fa fa-warning"> No ha llenado toda la información</div></div>');
        return;        
    }

    data_Imagen.i_step = i_step;
    data_Imagen.s_desc = s_desc;
    data_Imagen.i_tipo = i_tipo;


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    
    
    $.ajax({
        type: 'POST',
        url: '../guardarEvidencia',
        data: data_Imagen,
        dataType: 'text',
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(){
            swal("Evidencia guardada con exito!", "Oprima OK para continuar!", "success");
            $(":file").filestyle('clear');
            $('#preview').removeAttr('src');
            $('#descripcion').val('');
            data_Imagen=null;
            window.location.reload(true);
        },
        error: function(){
            swal("Error al guardar la Evidencia!", "Intente de nuevo!", "error");
        }


    });
    
});

//Recomienda verificar los steps en el checkin antes de continuar con el checkout-------------------------------------------------------------------------------------------

$(document).on('click', '.comprobar', function(event){
    var Comp = $('#comprobar').val();
    var i_idOrden  = $(this).attr('data-idorden');
    var s_elm = $(this);
 event.preventDefault();
       console.log(s_elm)                 
// return;
    swal({
          title: "¡RECUERDE!, aún puede haber esteps por verificar",
          text: "DESEA CONTINUAR?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Continuar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
         
       function(isConfirm) {

      if (isConfirm) 
        {

       swal("CONTINUAR", "", "success");
        window.location = s_elm[0].href;
         }
      else {
        swal("Cancelado", "", "error");
      }

    });

 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

});

//Recomienda verificar los steps del checkout antes de finalizar-------------------------------------------------------------------------------------

$(document).on('click', '.finished', function(event){
    var Compara = $('#finished').val();
    var s_elm = $(this);
      event.preventDefault();
       console.log(s_elm)                 
// return;
    swal({
          title: "¡ESTOS STEPS SON IMPORTANTES!, RECUERDE HACERLOS",
          text: "DESEA CONTINUAR?",
          type: "warning",
          showCancelButton: true,
          confirmButtonText: "Continuar",
          cancelButtonText: "Cancelar",
          closeOnConfirm: false,
          closeOnCancel: false
        },
         
       function(isConfirm) {

      if (isConfirm) 
        {

       swal("CONTINUAR", "", "success");
        window.location = s_elm[0].href;
         }
      else {
        swal("Cancelado", "", "error");
      }

    });

 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

});


function verDispProf(id){
  location.href = 'visualizarAgenda/'+id+'/edit';
}

function mostrarOcultar(muestraOculta,id){

  element = document.getElementById(id);
  if(muestraOculta=='muestra'){
     element.style.display='block'
  }
  else if(muestraOculta=='oculta'){
    element.style.display = 'none';
  }
}

function selecPlan(plan){

    var anexPlan='';
    var valhorasPlan=0;
    
    
    if (plan==1){
        valPlansel=22000;
        valhorasplan=2;
        anexPlan='<p>SERVICIO DE 2 HORAS<br>Servicio general de aseo recomendado ';
        anexPlan+='para un área no mayor a 45 metros cuadrados actividades que incluyen: ';
        anexPlan+='barrer, trapear, sacudir, limpieza de baños, limpieza de cocina, lavado';
        anexPlan+=' de ropa en maquina (incluida por el cliente)<br></p>';
        anexPlan+='<p>Horas nocturnas desde la 19:00 horas hasta las 6:00 horas es el 1.5  veces el valor<br></p>';
        anexPlan+='<p>Horas dominicales desde 12:00 horas hasta las 23:59 horas es el 2 veces el valor</p>';

        mostrarOcultar('oculta','fAdicional1')
        mostrarOcultar('oculta','fAdicional2')
    }
    if (plan==2){
        valPlansel=35000;
        valhorasplan=4;
        anexPlan='<p>SERVICIO DE 4 HORAS<br>Servicio general de aseo recomendado para un ';
        anexPlan+='área no mayor a 90 metros cuadrados actividades que incluyen: barrer, trapear,';
        anexPlan+=' sacudir, limpieza de baños, limpieza de cocina, lavado de ropa en maquina ';
        anexPlan+=' (incluida por el cliente)<br></p>';
        anexPlan+='<p>Horas nocturnas desde la 19:00 horas hasta las 6:00 horas es el 1.5  veces el valor<br></p>';
        anexPlan+='<p>Horas dominicales desde 12:00 horas hasta las 23:59 horas es el 2 veces el valor</p>';
        mostrarOcultar('oculta','fAdicional1')
        mostrarOcultar('oculta','fAdicional2')
    }
    if (plan==3){
        valPlansel=48000;
        valhorasplan=6;
        anexPlan='<p>SERVICIO DE 6 HORAS<br>Servicio general de aseo recomendado para un área '; 
        anexPlan+='no mayor a 130 metros cuadrados actividades que incluyen: barrer, trapear, sacudir, ';
        anexPlan+='limpieza de baños, limpieza de cocina, lavado de ropa en maquina (incluida por el cliente)<br></p>';
        anexPlan+='<p>Horas nocturnas desde la 19:00 horas hasta las 6:00 horas es el 1.5  veces el valor<br></p>';
        anexPlan+='<p>Horas dominicales desde 12:00 horas hasta las 23:59 horas es el 2 veces el valor</p>';
        mostrarOcultar('muestra','fAdicional1')
        mostrarOcultar('muestra','fAdicional2')
    }
    if (plan==4){
        valPlansel=60000;
        valhorasplan=8;
        anexPlan='<p>SERVICIO DE 8 HORAS<br>Servicio general de aseo recomendado para un área ';
        anexPlan+='mayor a 131 metros cuadrados actividades que incluyen: barrer, trapear, sacudir, limpieza ' ;
        anexPlan+='de baños, limpieza de cocina, lavado de ropa en maquina (incluida por el cliente)<br></p>';
        anexPlan+='<p>Horas nocturnas desde la 19:00 horas hasta las 6:00 horas es el 1.5  veces el valor<br></p>';
        anexPlan+='<p>Horas dominicales desde 12:00 horas hasta las 23:59 horas es el 2 veces el valor</p>';
        mostrarOcultar('muestra','fAdicional1')
        mostrarOcultar('muestra','fAdicional2')
    }

    mostrarOcultar('muestra','bloque2');
    mostrarOcultar('oculta','bloque1');

    $('#valSelectado').val(plan);
    $('#etiqPlanSel').html('Plan: '+plan);
    $('#valplanSel').html('Valor: $'+valPlansel);
    $('#nominacion').val(valPlansel);
    $('#anexoPlan').html(anexPlan);
    $('#horasPlan').val(valhorasplan);
    
    // $('#<%=lblPlanSel.ClientID%>').html("Nuevo valor"); 
}

function ClientGuardaOrden(idProfesional,nombreprofesional){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });


    var f = new Date();

    horaInicial=$('#horaInicial').val();
    horafin=(parseInt(horaInicial.substring(0,2))+Number(horasPlan))+horaInicial.substring(2,5);

    var dd=f.getDate();
    var mm=f.getMonth()+1;

    if (dd<10){
        dd='0'+dd;
    }
    if (mm<10){
        mm='0'+mm;
    }


    inmueble=$('#InputDireccion').val()
    empresa=1
    usuarioId=idProfesional
    estadoOrden=1
    fechaOrden=f.getFullYear()+'-'+mm+'-'+dd+' 00:00:00'
    inicioOrden=$('#fechaAsig').val()+' '+ horaInicial+':00'
    finOrden=$('#fechaAsig').val()+' '+ horafin+':00'
    tipoOrden=1
    cliente=$('#idcliente').val()
    costo=$('#nominacion').val()
    nomprof=nombreprofesional


    $.ajax({
        type: 'POST',
        url: '../store',
        data: {inmueble:inmueble,empresa:empresa,usuarioId:usuarioId,cliente:cliente,estadoOrden:estadoOrden,fechaOrden:fechaOrden,inicioOrden:inicioOrden,finOrden:finOrden,tipoOrden:tipoOrden},
  
        success: function(data){
            // swal("", "", "");
            swal({
              title: "orden de servicio creada y guardada con exito!",
              text: "Oprima OK para continuar!",
              type: "success",
              showCancelButton: false,
              confirmButtonClass: "btn-primary",
              confirmButtonText: "Aceptar!",
              cancelButtonClass: "btn-danger",
              cancelButtonText: "Cancelar!",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm) {
              if (isConfirm) {
                $('#modalProfesional').html(nomprof);
                $('#modalFechaHora').html(inicioOrden);
                $('#modalCosto').html('$ '+costo);
                $('#modalResumen').modal('show')
                // window.location.href = "../ordenC";
              }
            });

            // $(":file").filestyle('clear');
            // $('#preview').removeAttr('src');
            // $('#descripcion').val('');
            // data_Imagen=null;
            // window.location.reload(true);
        },
        error: function(){
            swal("Error al guardar la orden!", "Intente de nuevo!", "error");
        }
    }); 
}

$(document).on('click','.cerrarModalResumen',function(){
    window.location.href = "../ordenC";
});







//anular orden de servicio-----------------------------------------------------------------------------------------------------------------------
$(document).on('click', '.anularOrdencliente', function(){
    
    var s_nombre  = $(this).attr('data-nombre');
    var s_email   = $(this).attr('data-email');
    var s_direc   = $(this).attr('data-dir');
    var i_idorden = $(this).attr('data-id');
    var e_td      = $(this).parents('td');
    var boton1    = $(this);
    
    swal({
      title: "Está seguro de anular la orden de servicio?",
      text: "",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-primary",
      confirmButtonText: "Anular!",
      cancelButtonClass: "btn-danger",
      cancelButtonText: "Cancelar!",
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $.ajax({
            type : 'POST',
            url : 'anularOrdenCliente',
            data : {i_idorden : i_idorden, s_email : s_email, s_nombre : s_nombre, s_direc : s_direc},
            beforeSend: function(){
                var dim = $('#dimmer');
                dim.css("display", "block");
            },
            complete:function(){
                var dim = $('#dimmer');
                dim.css("display", "none");
            },
            success: function(data){
                boton1.parents('tr').find('.cancelarOrden').remove();
                $('.tooltip').remove();
                e_td.html('<span class="badge bg-red" data-toggle="tooltip" title="" data-placement="top" data-original-title="Orden de Pago Anulada"> Anulado </span>');
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-success alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-check" aria-hidden="true"></span> Orden de Servicio Anulada. Se envió e-mail de confirmación</div></div></div>')
                swal("Anulada!", "La orden de servicio ha sido anulada.", "success");
            },
            error: function(){
                $('.resultado').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Error al Anular la Orden. Contacte al administrador</div></div></div>');
                swal("Error", "La orden de servicio no fue anulada", "error");
            }
        });
    } else {
        swal("Cancelada", "La orden de servicio no fue anulada", "error");
      }
    });
});

//Buscador de Ordenes Módulo Cliente----------------------------------------------------------------------------------------------------------
$(document).on('click', '#buscarOrdCliente', function(){

    var i_estadoOrden       = $('#estadoOrd').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : 'buscarOrdCliente',
        data : {i_estadoOrden : i_estadoOrden},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
            $(".table_").html(data);
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});

//finalizar la orden de servicio con su respectiva calificación----------------------------------------------------------------------------------------------------------
$(document).on('click', '#finalizarOrdenCliente', function(){
    
    var calif     = $('input[name=estrellas]:checked', '#formulario').val();
    var obser     = $('#obser').val();
    var dataord   = $('#orden').val();
    var cliente  = $('#cliente').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

    $.ajax({
        type : 'POST',
        url : '../calificarordenCliente',
        data : { calif : calif, obser : obser, dataord : dataord, cliente : cliente},
        beforeSend: function(){
            var dim = $('#dimmer');
            dim.css("display", "block");
        },
        complete:function(){
            var dim = $('#dimmer');
            dim.css("display", "none");
        },
        success: function(data){
          
              window.location.href='../ordenC';
        },
        error: function(){
            $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});


$( "#buscaProfOdenCli" ).on( "click", function() {

    plan           = $('#valSelectado').val();
    fecha          = $('#fechaAsig').val();
    horaInicial    = $('#horaInicial').val();
    plancha        = document.getElementById("CheckAdicional1").checked;
    cocina         = document.getElementById("CheckAdicional2").checked;
    horasPlan      = $('#horasPlan').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });

     $.ajax({
        type : 'POST',
        url : '../buscaProfOrdenCliente',
        data : { plan : plan, fecha : fecha, horaInicial : horaInicial, plancha : plancha, cocina : cocina, horasPlan : horasPlan },
        beforeSend: function(){
            // var dim = $('#dimmer');
            // dim.css("display", "block");
        },
        complete:function(){
            // var dim = $('#dimmer');
            // dim.css("display", "none");
        },
        success: function(data){
            // mostrarOcultar('muestra','bloque4');
            mostrarOcultar('oculta','bloque3');
            $('#bloque4').html(data);
          
              // window.location.href='../ordenC';
        },
        error: function(){
            // $('.busqueda').html('<div class="row"><div class="col-md-6 col-md-offset-3"><div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Problemas al tratar de hacer la busqueda. Contacte al administrador</div></div></div>');
        }
    });
});
/*
    * * * * *  DEJAR AL FINAL DE TODAS LAS FUNCIONES * * * * *
*/
// ESTILO DE INPUT FILE----------------------------------------------------------------------------------------
    $('#BSbtninfo').filestyle({
        iconName : 'glyphicon glyphicon-circle-arrow-up',
        buttonName : 'btn-danger',
        buttonText : ' Subir Foto'
    });
// FIN ESTILO DE INPUT FILE