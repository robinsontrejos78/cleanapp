<!-- <option value="">Seleccione opción</option> -->
@foreach($personas as $persona)
	<option value="{{ $persona->id }}">{{ $persona->name }} {{ $persona->USR_APELLIDOS }}</option>
@endforeach