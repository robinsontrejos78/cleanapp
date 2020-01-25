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
        <h3 class="box-title">Editar Usuario</h3>
      </div>

      <div class="box-body">
      <form action="{{ url('user/'.$user->id) }}" method="POST" class="form-group">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">
          <div class="col-md-6">
            <label for="nombreUsu" style="margin-top:20px">Nombres</label>
            <input type="text" class="form-control" id="nombreUsu" name="nombreUsu" placeholder="Nombres del Usuario" value="{{ $user->name }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="apellidoUsu" style="margin-top:20px">Apellidos</label>
            <input type="text" class="form-control" id="apellidoUsu" name="apellidoUsu" placeholder="Apellidos del usuario" value="{{ $user->USR_APELLIDOS }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="documentoUsu" style="margin-top:20px">Documento</label>
            <input type="text" class="form-control" id="documentoUsu" name="USR_DOCUMENTO" placeholder="Documento del usuario" value="{{ $user->USR_DOCUMENTO }}">
          </div>
          <div class="col-md-6">
            <label for="telefonoUsu" style="margin-top:20px">Teléfono</label>
            <input type="number" class="form-control" id="telefonoUsu" name="telefonoUsu" placeholder="Teléfono del Usuario" value="{{ $user->USR_TELEFONO }}">
          </div><div class="col-md-6">
            <label for="celularUsu" style="margin-top:20px">Celular</label>
            <input type="number" class="form-control" id="celularUsu" name="celularUsu" placeholder="Teléfono Movil del Usuario" value="{{ $user->USR_CELULAR }}">
          </div>
          <div class="col-md-6">
            <label for="direccionUsu" style="margin-top:20px">Dirección</label>
            <input type="text" class="form-control" id="direccionUsu" name="direccionUsu" placeholder="Dirección del Usuario" value="{{ $user->USR_DIRECCION }}">
          </div>
          <div class="col-md-6">
            <label for="emailUsu" style="margin-top:20px">Email</label>
            <input type="email" class="form-control" id="emailUsu" name="emailUsu" placeholder="Correo electrónico" value="{{ $user->email }}" onkeyup="this.value=this.value.toLowerCase();">
          </div>
          <div class="col-md-6" style="margin-top:20px">
            <label for="empresaUsu">Empresa</label>
            <select name="empresaUsu" id="empresaUsu" class="form-control">
              @foreach($empresas as $empresa)
                <option value="{{ $empresa->EMP_IDEMPRESA }}" @if($user->EMP_IDEMPRESA == $empresa->EMP_IDEMPRESA) selected @endif>{{ $empresa->EMP_NOMBRE }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-12">
            <br>
            <input type="submit" name="guardarUsuario" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear Usuario">
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