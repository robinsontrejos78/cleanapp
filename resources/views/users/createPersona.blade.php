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
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Crear Persona</h3>
      </div>

      <div class="box-body">
      <form action="{{ url('storePersona') }}" method="POST" class="form-group deshabilita">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="col-md-6">
            <label for="nombrePer" style="margin-top:20px">Nombres</label>
            <input type="text" class="form-control" id="nombrePer" name="nombrePer" placeholder="Nombres del Usuario" value="{{ old('nombrePer') }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="apellidoPer" style="margin-top:20px">Apellidos</label>
            <input type="text" class="form-control" id="apellidoPer" name="apellidoPer" placeholder="Apellidos del usuario" value="{{ old('apellidoPer') }}" onkeyup="this.value=this.value.toUpperCase();">
          </div>
          <div class="col-md-6">
            <label for="documentoPer" style="margin-top:20px">Documento</label>
            <input type="text" class="form-control" id="documentoPer" name="USR_DOCUMENTO" placeholder="Documento del usuario" value="{{ old('USR_DOCUMENTO') }}">
          </div>
          <div class="col-md-6">
            <label for="telefonoPer" style="margin-top:20px">Teléfono</label>
            <input type="number" class="form-control" id="telefonoPer" name="telefonoPer" placeholder="Teléfono del Usuario" value="{{ old('telefonoPer') }}">
          </div>
          <div class="col-md-6">
            <label for="celularPer" style="margin-top:20px">Celular</label>
            <input type="number" class="form-control" id="celularPer" name="celularPer" placeholder="Teléfono Movil del Usuario" value="{{ old('celularPer') }}">
          </div>
          <div class="col-md-6">
            <label for="direccionPer" style="margin-top:20px">Dirección</label>
            <input type="text" class="form-control" id="direccionPer" name="direccionPer" placeholder="Dirección del Usuario" value="{{ old('direccionPer') }}">
          </div>
          <div class="col-md-6">
            <label for="emailPer" style="margin-top:20px">Email</label>
            <input type="email" class="form-control" id="emailPer" name="emailPer" placeholder="Correo electrónico" value="{{ old('emailPer') }}" onkeyup="this.value=this.value.toLowerCase();">
          </div>
          <div class="col-md-6">
            <label for="generoPer" style="margin-top:20px">Género de la Persona</label>
            <select name="generoPer" id="generoPer" class="form-control">
              <option value="">Seleccione opción</option>
              <option value="0" @if(old('generoPer') == 0) selected @endif>Personal Femenino</option>
              <option value="1" @if(old('generoPer') == 1) selected @endif>Personal Masculino</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="tipoPer" style="margin-top:20px">Tipo de Persona</label>
            <select name="tipoPer" id="tipoPer" class="form-control">
              <option value="">Seleccione opción</option>
              <option value="1" @if(old('tipoPer') == 1) selected @endif>Personal de Aseo</option>
              <option value="2" @if(old('tipoPer') == 2) selected @endif>Personal de Mantenimiento</option>
              <option value="3" @if(old('tipoPer') == 3) selected @endif>Personal Inventario</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="ciudadPer" style="margin-top:20px">Ciudad de la Persona</label>
            <select name="ciudadPer" id="ciudadPer" class="form-control">
                <option value="">Seleccione opción</option>
              @foreach($ciudades as $ciudad)
                <option value="{{ $ciudad->CIU_IDCIUDAD }}" @if(old('ciudadPer') == $ciudad->CIU_IDCIUDAD) selected @endif>{{ $ciudad->CIU_NOMBRE }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <label for="passwordPer" style="margin-top:20px">Password</label>
            <input type="text" class="form-control" id="passwordPer" name="passwordPer" placeholder="Contraseña" value="{{ old('passwordPer') }}">
          </div><div class="col-md-6">
            <label for="passwordPer_confirmation" style="margin-top:20px">Confirmar Password</label>
            <input type="text" class="form-control" id="passwordPer_confirmation" name="passwordPer_confirmation" placeholder="Confirmar Contraseña" value="{{ old('passwordUsu_confirmation') }}">
          </div>
          <div class="col-md-12" style="margin-top:30px">
            <input type="submit" name="guardarUsuario" value="Guardar" class="btn btn-success" data-toggle="tooltip" title="" data-container="body" data-original-title="Crear Personal">
            <a href="{{ url('indexPersona') }}"><button type="button" class="btn btn-danger" data-toggle="tooltip" title="" data-container="body" data-original-title="Regresar al Administrador de Personal">Cancelar</button></a>
          </div>
          
    </form>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>

@endsection