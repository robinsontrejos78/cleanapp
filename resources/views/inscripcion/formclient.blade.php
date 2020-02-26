
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
            <div class="box box-info box-solid" style="width: 500px" >
                <div class="box-header with-border" >
                    <h3 class="box-title" >Formulario de Inscripción Para Clientes</h3>
                </div>

                <form >
                    <div class="box-body">

                        <div class="form-group">
                            <input type="text" class="form-control" id="nombres" required onkeyup="this.value=this.value.toUpperCase();" placeholder="Ingrese su nombre">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="apellidos" onkeyup="this.value=this.value.toUpperCase();" placeholder="Ingrese sus apellidos">
                        </div>
                        <div class="form-group">
                            <select name="tipodo" id="tipodoc" class="form-control" >
                                <option value="">Seleccione tipo documento...</option>
                                <option value="C.C">C.C.</option>
                                <option value="C.E">C.E.</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" id="numerodoc" placeholder="Ingrese el número Documento">
                        </div>

                        <div class="form-group">
                                <input type="direc" class="form-control" id="direccion" placeholder="ingrese su dirección">
                        </div>

                        <div class="form-group">
                            <input type="Number" class="form-control" id="telefono" placeholder="Ingrese su teléfono">
                        </div>

                        <div class="form-group">
                            <select name="city" id="city" class="form-control">
                                <option value="">Seleccione ciudad...</option>
                                @foreach($ciudades as $ciudad)
                                    <option value="{{ $ciudad->CIU_IDCIUDAD }}" @if($ciudad->CIU_IDCIUDAD == old('ciudadFrmcli')) selected @endif>{{ $ciudad->CIU_NOMBRE }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <input type="email" class="form-control" onkeyup="this.value=this.value.toLowerCase();" id="mail" placeholder="Correo Electrónico">
                        </div>

                        <div class="form-group" align="left">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="datos" checked> <a target="_blank" href="{{ url('habeas') }}"> Acepto Política Tratamiento de Datos</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" align="left">
                            <div class="col-sm-offset-2 col-sm-10">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  id="terminos"> <a target="_blank" href="{{ url('terminos') }}"> Terminos y Condiciones</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="box-footer box-solid">
                        <a href="{{ url('/') }}"> <button type="button" class="btn btn-default">Salir</button></a>
                        <button type="button" id="inscripcionCliente" class="btn btn-info pull-right">Aceptar</button>
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
