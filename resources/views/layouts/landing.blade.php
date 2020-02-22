<!DOCTYPE html>
<!--
Landing page based on Pratt: http://blacktie.co/demo/pratt/
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }} ">
    <meta name="author" content="Sergi Tur Badenas - acacha.org">

    <meta property="og:title" content="Adminlte-laravel" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Adminlte-laravel - {{ trans('adminlte_lang::message.landingdescription') }}" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org/" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x600.png" />
    <meta property="og:image" content="http://demo.adminlte.acacha.org/img/AcachaAdminLTE600x314.png" />
    <meta property="og:sitename" content="demo.adminlte.acacha.org" />
    <meta property="og:url" content="http://demo.adminlte.acacha.org" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@acachawiki" />
    <meta name="twitter:creator" content="@acacha1" />

    <title>C L E A N A P P S</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>
<!-- jQuery 2.1.4 -->
<script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
<!-- iCheck -->
<script src="{{ asset('/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('/js/smoothscroll.js') }}"></script>


</head>

<body data-spy="scroll" data-offset="0" data-target="#navigation">

<!-- Fixed navbar -->
<div id="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
           <!--  <a class="navbar-brand" href="{{ url ('home') }}"><b>CLEANAPPS</b></a> -->
        </div>
        <div class="navbar-collapse collapse">
    
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                    <h3><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></h3>
                @endif<br>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>

<section id="home" name="home"></section>

<div class="modal modal-success fade" id="myModalinfo">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">CleanApps</h4>
        </div>
        <div class="modal-body">
        <p>Es la mejor opción para ti?. Sí:</p>
            <ul>
              <li>Buscas una frecuencia de limpiezas definida (semanal o quincenal)</li>
              <li>Quieres la limpieza en días fijos a la semana</li>
              <li>Quieres que vaya siempre la misma profesional</li>
              <li>Quieres ahorrar dinero y tiempo en cada limpieza</li>
            </ul>
            <br>
         <p>Queremos que estés 100% feliz y satisfecho con CLEANAPPS, por eso recuerda que:</p>
            <ul>
              <li>Si no quedas satisfecho, te compensaremos por ello</li>
              <li>Si no te gusta la profesional, puedes solicitar un cambio sin costo.</li>
              <li>Cada limpieza cuenta con un seguro contra daños.</li>
            </ul>   
            <br>
         <p>¿Cómo funciona?</p>
            <ul>
              <li>Pagas el servicio en efectivo o por medio de la aplicación.</li>
              <li>Puedes agendar, reprogramar, congelar o anular la limpieza según tus necesidades.</li>
            </ul>  
             <br>
         <p>Entiende tu puntuación </p>
            <ul>
              <li>Las puntuaciones nos permiten asegurar una gran experiencia en CLEANAPPS tanto para los clientes como para las profesionales. De la misma forma que tú puedes evaluar a tus profesionales y los profesionales pueden evaluarte a ti.</li>
            </ul>  
             <br>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</div>


<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
            <br><br><span style="color:silver;font-weight:bold">CONOCENOS:</span>
                <h2><font color="blue">C L E A N<b></font><a href="" id="btn_modalinfo"  data-toggle="modal" data-target="#myModalinfo"> A P P S</a></b></h2><br>
            </div>
        </div>
    </div> <!--/ .container -->
</div><!--/ #headerwrap -->
<br>

<div id="headerwrap">
        <div class="row centered">
            <div class="col-lg-12">
            <br><br><span style="color:silver;font-weight:bold">CLIENTES:</span>
                <h2><font color="skyblue">SOLICITAR <b></font><a href="{{ url ('formcliente') }}"> SERVICIO</a></b></h2>
                @if (Auth::guest())
                    <B><h1><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></h1><B>
                @endif<br>
            </div>
        </div>
</div>
<br>

<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-12">
            <br><br><span style="color:silver;font-weight:bold">PROFESIONALES:</span>
                <h2><font color="DODGERBLUE">TRABAJA CON <b></font><a href="{{ url ('formprofe') }}"> NOSOTROS</a></b></h2> 
                @if (Auth::guest())
                    <B><h1><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></h1></B>
                @endif<br>
            </div>
        </div>
    </div> <!--/ .container -->
</div>


<!-- Placed at the end of the document so the pages load faster -->
<!-- <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script> -->

</body>
</html>
