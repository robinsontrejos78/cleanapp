
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

<div class="box box-primary box-solid" style="width: 500px" align="center">
            <div class="box-header with-border" align="center">
              <h3 class="box-title" >Formulario de Inscripción Para Profesionales de Aseo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body" align="right">
                 <div class="form-group">
                  <label for="nombres"  class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-8" >
                    <input type="text" class="form-control" id="nombresprof" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Names">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="apellidosprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="text" class="col-sm-2 control-label">Tipo Doc</label>
                  <div class="col-sm-8">
                    <select name="tipodocpro" id="tipodocprof" class="form-control" >
                    <option value="">Doc Type</option>
                    <option value="C.C">C.C.</option>
                    <option value="C.E">C.E.</option>
                    <option value="T.I">T.I.</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Número Doc</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="numdocprof" placeholder="ID">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dir" class="col-sm-2 control-label">Fecha de Nacimiento</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="fnaciprof" placeholder="Birthday">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="rageage" class="col-sm-2 control-label">Género</label>
                  <div class="col-sm-8">
                    <select name="genero" id="generoprof" class="form-control" >
                    <option value="">Gender</option>
                     <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="Otro">Otro</option>
                  </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="dir" class="col-sm-2 control-label">Donde Vive</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="lugarnacprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Pais/Depto/Ciudad">
                  </div>
                </div>
                <div class="form-group">
                  <label for="dir" class="col-sm-2 control-label">Antiguedad en esta Ciudad</label>
                  <div class="col-sm-8">
                    <select name="estado" id="antigprof" class="form-control" >
                    <option value="">Menos de 1 año</option>
                    <option value="Casado">Entre 1 y 3</option>
                    <option value="Union Libre">Entre 3 y 5</option>
                    <option value="Separado">Más de 5 años</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="rageage" class="col-sm-2 control-label">Estado Civil</label>
                  <div class="col-sm-8">
                    <select name="estado" id="estcivilprof" class="form-control" >
                    <option value="">Marital Status</option>
                     <option value="Casado">Casado(a)</option>
                    <option value="Union Libre">Unión Libre</option>
                    <option value="Separado">Separado(a)</option>
                    <option value="Soltero">Soltero(a)</option>
                    <option value="Otro">Otro</option>
                  </select>
                  </div>
                </div>
                 <div class="form-group">
                  <label for="dir" class="col-sm-2 control-label">Dirección</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="dirprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Address">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="telephone" class="col-sm-2 control-label">Celular</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="telprof" placeholder="Phone Number">
                  </div>
                </div>
                <div class="form-group">
                  <label for="telephone" class="col-sm-2 control-label">Teléfono Residencia</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="telresprof" placeholder="Phone Number">
                  </div>
                </div>

                <div class="form-group">
                  <label for="mail" class="col-sm-2 control-label">Correo Electrónico</label>
                  <div class="col-sm-8">
                    <input type="email" id="mailprof" class="form-control" onkeyup="this.value=this.value.toLowerCase();" placeholder="Email">
                  </div>
                </div>
                  <div class="form-group">
                  <label for="rageage" class="col-sm-2 control-label">Nivel de Estudios</label>
                  <div class="col-sm-8">
                    <select name="nivel" id="nivelprof" class="form-control" >
                    <option value="">scholarship</option>
                     <option value="Primaria">Primaria</option>
                    <option value="Bachiller">Bachiller</option>
                    <option value="Técnico">Técnico</option>
                    <option value="Tecnológico">Tecnológico</option>
                    <option value="Profesional">Profesional</option>
                    <option value="Sin Estudios">Sin Estudios</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="city" class="col-sm-2 control-label">Total Personas a Cargo</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="percarprof"  placeholder="">
                  </div>
                </div>
            <div class="box box-info">
            <div class="box-header with-border" >
              <h3 class="box-title" >Datos Cónyugue</h3>
            </div>
            <div class="form-group">
                  <label for="nombres"  class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nomcon" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Names">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="apecon" onkeyup="this.value=this.value.toUpperCase();" placeholder="Last Name">
                  </div>
                </div>
             <div class="form-group">
                  <label for="text" class="col-sm-2 control-label">Tipo Doc</label>
                  <div class="col-sm-8">
                    <select name="tipodo" id="tipodoccon" class="form-control" >
                    <option value="">Doc Type</option>
                    <option value="C.C">C.C.</option>
                    <option value="C.E">C.E.</option>
                    <option value="T.I">T.I.</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Número Doc</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="numerodoccon" placeholder="ID">
                  </div>
                </div>
            </div>
            <div class="box box-info">
            <div class="box-header with-border" >
              <h3 class="box-title" >Referencia Familiar</h3>
            </div>
                <div class="form-group">
                  <label for="nombres"  class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombrefa" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Names">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="aperefa" onkeyup="this.value=this.value.toUpperCase();" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Parentesco</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="parentrefa" onkeyup="this.value=this.value.toUpperCase();" placeholder="Relationship">
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="citirefa" onkeyup="this.value=this.value.toUpperCase();" placeholder="City">
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="telrefa" placeholder="Phone Number">
                  </div>
                </div>
                </div>
               
             
             <div class="box box-info">
            <div class="box-header with-border" >
              <h3 class="box-title">Referencia Personal/Comercial</h3>
            </div>
            <div class="box-header with-border" >
                <div class="form-group">
                  <label for="nombres"  class="col-sm-2 control-label">Nombres</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="nomrefcoma" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Names">
                  </div>
                </div>
                 <div class="form-group">
                  <label for="apellidos" class="col-sm-2 control-label">Apellidos</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="aperefcoma" onkeyup="this.value=this.value.toUpperCase();" placeholder="Last Name">
                  </div>
                </div>
            
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Parentesco</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="parentrefcoma" onkeyup="this.value=this.value.toUpperCase();" placeholder="Relationship">
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Ciudad</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="citicoma" onkeyup="this.value=this.value.toUpperCase();" placeholder="City">
                  </div>
                </div>
                <div class="form-group">
                  <label for="numdoc" class="col-sm-2 control-label">Teléfono</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="telrefcoma" placeholder="Phone >Number">
                  </div>
                </div>
              </div>
               <br>
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
                <br>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" align="center">
                <a href="http://localhost/cleanapps"> <button type="button" class="btn btn-default">Salir</button></a>
                <button type="button" id="inscripcion"  class="btn btn-info pull-right">Aceptar</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
</div>

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
