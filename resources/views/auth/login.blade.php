@extends('layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
@if(Session::has('message'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-success alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon" aria-hidden="true"></span> {{Session::get('message')}}
      </div>
    </div>
  </div>  
@endif
        
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">

            <a href="{{ url('/home') }}">Te damos la Bienvenida!</a>

        </div>



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
       
<div class="box box-success box-solid">
    <div style="border-top: 2px solid blue" class="login-box-body">
    <p class="login-box-msg">Ingresa tu Documento y Contraseña</p>
    <form action="{{ url('/login') }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <meta name="_token" content="{{ csrf_token() }}"/>
        <div class="form-group has-feedback">
            <input type="text" class="form-control docusu" placeholder="Documento" name="USR_DOCUMENTO"/>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        
        <div class="form-group has-feedback busqueda">
            
        </div>
    </form>
    <br>
    <a href="{{ url('/password/reset') }}">Olvidé mi Contraseña</a><br>
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
