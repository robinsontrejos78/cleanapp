
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="_token" content="{{ csrf_token() }}"/>
<meta http-equiv="Expires" content="0">
<meta http-equiv="Last-Modified" content="0">
<meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
<meta http-equiv="Pragma" content="no-cache">
@extends('layouts.auth')
@section('main-content')
@section('htmlheader_title')
    Log in
@endsection


@section('content')
<meta name="_token" content="{{ csrf_token() }}"/>



<body class="hold-transition login-page">
    <div class="login-box">
       

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Hay problema con los datos ingresados<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



<div class="row">
<div class="box box-info" style="width: 500px" >
            <div class="box-header with-border box-solid" >
              <h3 class="box-title" >Formulario de Inscripción Para Clientes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box box-primary box-solid">
                 <div class="form-group">
                  <label for="nombres"  class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="nombres" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Names">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="apellidos" onkeyup="this.value=this.value.toUpperCase();" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="text" class="col-sm-2 control-label">Tipo Doc</label>
                  <div class="col-sm-10">
                    <select name="tipodo" id="tipodoc" class="form-control" >
                    <option value="">Doc Type</option>
                    <option value="C.C">C.C.</option>
                    <option value="C.E">C.E.</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Número Doc</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="numerodoc" placeholder="ID">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="dir" class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-10">
                    <input type="direc" class="form-control" id="direccion" placeholder="Address">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="telephone" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-sm-10">
                    <input type="Number" class="form-control" id="telefono" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="city" class="col-sm-2 control-label" >Ciudad</label>

                  <div class="col-sm-10">
                    <input type="cyti" class="form-control" id="ciudad" onkeyup="this.value=this.value.toUpperCase();" placeholder="City">
                  </div>
                </div>
                <div class="form-group">
                  <label for="mail" class="col-sm-2 control-label">Correo Electrónico</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" onkeyup="this.value=this.value.toLowerCase();" id="mail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="datos" checked> <a target="_blank" href="{{ url('habeas') }}"> Acepto Política Tratamiento de Datos</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"  id="terminos"> <a target="_blank" href="{{ url('terminos') }}"> Terminos y Condiciones</a>
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer box-solid">
                <a href="http://localhost/cleanapps"> <button type="button" class="btn btn-default">Salir</button></a>
                <button type="button" id="inscripcion" value class="btn btn-info pull-right">Aceptar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>

    <br>
    <!-- <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a> -->

</div>

</div>


    @include('layouts.partials.scripts_auth')
    <script src="{{ asset('/js/servicios.js')}}" type="text/javascript"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection
