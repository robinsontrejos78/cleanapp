@extends('layouts.app')

@section('main-content')



<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">

        <h3 class="box-title">Ciudad</h3>
        <div>
        <div>
        <input type="text" name="ciudad">
        </div>
        </div>
      </div>

      <div class="box-body">
        <h3 class="box-title">Departamento</h3>
        <div>
        <div>
        <input type="text" name="pais">
        </div>
        </div>
      </div>

      <div class="box-footer">
       	Pie
      </div>
           
    </div>
  </div>
</div>

    <button type="button" class="btn btn-primary btn-xs" data-toggle="tooltip" title="" data-placement="top" data-original-title="Consultar"  data-container="body"><span class="glyphicon glyphicon-search"></span></button>
    <button type="button" class="btn btn-warning btn-xs" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar"  data-container="body"><span class="glyphicon glyphicon-pencil"></span></button>
    <button type="button" class="btn btn-success btn-xs" data-toggle="tooltip" title="" data-placement="top" data-original-title="Agregar"  data-container="body"><span class="glyphicon glyphicon-plus"></span></button>

    <br>
    <br>

    <button type="button" class="btn btn-success" data-toggle="tooltip" class="guardaciudad" title="Guardar" data-container="body">Guardar</button>
    <button type="button" class="btn btn-primary" data-toggle="tooltip" title="ÑAO" data-container="body">Buscar</button>
    <button type="button" class="btn btn-danger" data-toggle="tooltip" title="ÑAO" data-container="body">Cancelar</button>
@endsection