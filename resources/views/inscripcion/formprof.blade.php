
@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="_token" content="{{ csrf_token() }}"/>
   



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

<div class="box box-info box-solid" style="width: 400px" >
            <div class="box-header with-border">
              <h3 class="box-title" >Formulario de Inscripción Para Profesionales de Aseo</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body" align="right">
                 <div class="form-group">
                  <div class="col-sm-12" >
                    <input type="text" class="form-control" id="nombresprof" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombres">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="apellidosprof" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Apellidos">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="tipodocpro" id="tipodocprof" required class="form-control" >
                    <option>Tipo Documento</option>
                    <option value="C.C">C.C.</option>
                    <option value="C.E">C.E.</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" required id="numdocprof" placeholder="Número Documento">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 control-label">Fecha de Nacimiento</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" required id="fnaciprof" placeholder="Fecha Nacimiento">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <select name="genero" id="generoprof" required class="form-control" >
                    <option>Género</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                    <option value="Otro">Otro</option>
                  </select>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" required class="form-control" id="lugarnacprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Donde vive?">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="estado" id="antigprof" required class="form-control" >
                    <option>Antiguedad en esta Ciudad</option>
                    <option value="Menos de un año">Menos de 1 año</option>
                    <option value="Entre 1 y 3">Entre 1 y 3</option>
                    <option value="Entre 3 y 5">Entre 3 y 5</option>
                    <option value="Más de 5 años">Más de 5 años</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="estado" id="estcivilprof" required class="form-control" >
                    <option>Estado Civil</option>
                     <option value="Casado">Casado(a)</option>
                    <option value="Union Libre">Unión Libre</option>
                    <option value="Separado">Separado(a)</option>
                    <option value="Soltero">Soltero(a)</option>
                    <option value="Otro">Otro</option>
                  </select>
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" required class="form-control" id="dirprof" onkeyup="this.value=this.value.toUpperCase();" placeholder="Dirección">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="number" required class="form-control" id="telprof" placeholder="Celular">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="number" required class="form-control" id="telresprof" placeholder="Teléfono Residencia">
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="email" id="mailprof" class="form-control" onkeyup="this.value=this.value.toLowerCase();" placeholder="Correo Electrónico">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="nivel" required id="nivelprof" class="form-control" >
                    <option>Nivel de Escolaridad</option>
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
                  <div class="col-sm-12">
                    <input type="number" required class="form-control" id="percarprof"  placeholder="Total Personas a Cargo">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="nivel" required id="planchar" class="form-control" >
                    <option>Puede realizar labores de Planchado?</option>
                    <option value="1">SÍ</option>
                    <option value="0">NO</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <select name="nivel" required id="cocinar" class="form-control" >
                    <option>Puede realizar labores de Cocina?</option>
                    <option value="1">SÍ</option>
                    <option value="0">NO</option>
                  </select>
                  </div>
                </div>
            <div class="box box-info">
            <div class="box-header with-border" align="center">
              <h3 class="box-title" >Datos Cónyugue</h3>
            </div>
            <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="nomcon" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombres">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" required id="apecon" onkeyup="this.value=this.value.toUpperCase();" placeholder="Apellidos">
                  </div>
                </div>
             <div class="form-group">
                  <div class="col-sm-12">
                    <select name="tipodo" id="tipodoccon" required class="form-control" >
                    <option>Tipo Documento</option>
                    <option value="C.C">C.C.</option>
                    <option value="C.E">C.E.</option>
                    <option value="T.I">T.I.</option>
                  </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="number" class="form-control" required id="numerodoccon" placeholder="Número Documento">
                  </div>
                </div>
            </div>
            <div class="box box-info">
            <div class="box-header with-border" align="center">
              <h3 class="box-title" >Referencia Familiar</h3>
            </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="nombrefa" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombres">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="aperefa" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Apellidos">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="parentrefa" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Parentesco">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="citirefa" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Ciudad">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="number" class="form-control" id="telrefa" required placeholder="Teléfono">
                  </div>
                </div>
                </div>
               
             
             <div class="box box-info">
            <div class="box-header with-border" align="center">
              <h3 class="box-title">Referencia Personal/Comercial</h3>
            </div>
            <div class="box-header with-border" >
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="nomrefcoma" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Nombres">
                  </div>
                </div>
                 <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" id="aperefcoma" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Apellidos">
                  </div>
                </div>
            
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" required id="parentrefcoma" onkeyup="this.value=this.value.toUpperCase();" placeholder="Parentesco">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="text" class="form-control" required id="citicoma" onkeyup="this.value=this.value.toUpperCase();" placeholder="Ciudad">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    <input type="number" required class="form-control" id="telrefcoma" placeholder="Teléfono">
                  </div>
                </div>
              </div>
               <br>
                <div class="form-group" align="left">
                  <div class="col-sm-offset-2 col-sm-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" id="datos" required checked> <a target="_blank" href="{{ url('habeas') }}"> Acepto Política Tratamiento de Datos</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group" align="left">
                  <div class="col-sm-offset-2 col-sm-12">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" required  id="terminos"> <a target="_blank" href="{{ url('terminos') }}">Acepto Términos y Condiciones</a>
                      </label>
                    </div>
                  </div>
                </div>
                <br>
              </div>
              <!-- /.box-body -->
              <div class="box-footer" align="left">
                <a href="{{ url('/login')}}"> <button type="button" class="btn btn-default">Salir</button></a>
                <button type="button" id="inscripcion"  class="btn btn-info pull-right">Aceptar</button>
              </div>
              <!-- /.box-footer -->
                <div class="resultado"></div>
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
