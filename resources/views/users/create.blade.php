@extends('layouts.app')

@section('main-content')



@if (count($errors) > 0)
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif

<div class="row">
  <div class="col-md-12">
    <div class="box box-danger">

      <div class="box-header with-border">
        <h3 class="box-title">Crear Usuario</h3>
      </div>

      <div class="box-body">
      <form action="{{ url('user') }}" method="POST" class="form-group deshabilita">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-6">
            <label for="nombreUsu" style="margin-top:20px">Nombres</label>
            <input type="text" class="form-control" id="nombreUsu" name="nombreUsu" placeholder="Nombres del Usuario" value="{{ old('nombreUsu') }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="apellidoUsu" style="margin-top:20px">Apellidos</label>
            <input type="text" class="form-control" id="apellidoUsu" name="apellidoUsu" placeholder="Apellidos del usuario" value="{{ old('apellidoUsu') }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="documentoUsu" style="margin-top:20px">Documento</label>
            <input type="text" class="form-control" id="documentoUsu" name="USR_DOCUMENTO" placeholder="Documento del usuario" value="{{ old('documentoUsu') }}">
          </div>
          <div class="col-md-6">
            <label for="telefonoUsu" style="margin-top:20px">Teléfono</label>
            <input type="number" class="form-control" id="telefonoUsu" name="telefonoUsu" placeholder="Teléfono del Usuario" value="{{ old('telefonoUsu') }}">
          </div><div class="col-md-6">
            <label for="number" style="margin-top:20px">Celular</label>
            <input type="number" class="form-control" id="celularUsu" name="celularUsu" placeholder="Teléfono Movil del Usuario" value="{{ old('celularUsu') }}">
          </div>
          <div class="col-md-6">
            <label for="direccionUsu" style="margin-top:20px">Dirección</label>
            <input type="text" class="form-control" id="direccionUsu" name="direccionUsu" placeholder="Dirección del Usuario" value="{{ old('direccionUsu') }}">
          </div>
          <div class="col-md-6">
            <label for="emailUsu" style="margin-top:20px">Email</label>
            <input type="email" class="form-control" id="emailUsu" name="emailUsu" placeholder="Correo electrónico" value="{{ old('emailUsu') }}" onkeyup="this.value=this.value.toLowerCase();">
          </div>
          <div class="col-md-6" style="margin-top:20px">
            <label for="empresaUsu">Empresa</label>
            <select name="empresaUsu" id="empresaUsu" class="form-control">
              <option value="">Seleccione una Empresa</option>
              @foreach($empresas as $empresa)
                <option value="{{ $empresa->EMP_IDEMPRESA }}">{{ $empresa->EMP_NOMBRE }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="passwordUsu" style="margin-top:20px">Password</label>
            <input type="text" class="form-control" id="passwordUsu" name="passwordUsu" placeholder="Contraseña" value="{{ old('passwordUsu') }}">
          </div><div class="col-md-6">
            <label for="passwordUsu_confirmation" style="margin-top:20px">Confirmar Password</label>
            <input type="text" class="form-control" id="passwordUsu_confirmation" name="passwordUsu_confirmation" placeholder="Confirmar Contraseña" value="{{ old('passwordUsu_confirmation') }}">
          </div>
          <div class="col-md-1 col-md-offset-0" style="margin-top:30px">
            <input type="submit" name="guardarUsuario" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear Usuario">
          </div>
          <div class="col-md-1" style="margin-top:30px">
            <a href="{{ url('user') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Usuarios">Cancelar</button></a>
          </div>
    </form>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

@endsection