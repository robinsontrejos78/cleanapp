@extends('layouts.app')

@section('main-content')
<meta name="_token" content="{{ csrf_token() }}"/>

<!-- Ventana modal para confirmar pago de orden de servicio-->
<div class="example-modal">
  <div class="modal modal-default" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Información de la Orden de Servicio</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-hover table-striped">
              <tbody id="consultarPersona">
                  
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Cerrar sin Pagar</button>
          <button type="button" class="btn btn-primary">Pagar Orden</button>
        </div>
      </div>
    </div>
  </div>
</div>

@if(Session::has('message'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-success alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> - {{Session::get('message')}}
      </div>
    </div>
  </div>  
@endif

@if(Session::has('messageE'))
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="alert alert-danger alert-dismissible" role="alert" style="text-align:center">
        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> - {{Session::get('messageE')}}
      </div>
    </div>
  </div>  
@endif


<div class="row">
  <div class="col-xs-3">
    <a href="{{ url('ordenCliente/create') }}" class="btn btn-primary btn-flat">Agregar Orden de servicio</a>
  </div>
  <br>
  <br>
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">

      <div class="box-header with-border">
        <h3 class="box-title">Buscar Ordenes <span class="badge bg-teal"  data-toggle="tooltip" title="Puede filtrar la busqueda por estado de la orden" data-container="body"><i class="fa fa-fw fa-info-circle"></i></span></h3>
      </div>

      <div class="box-body">
        <div class="col-md-3">
          <label for="estadoOrd">Estado de la Orden</label>
            <select name="estadoOrd" id="estadoOrd" class="form-control">
                <option value="">Seleccione opción</option>
                @foreach($estadosO as $estados)
                    <option value="{{ $estados->LOO_IDLOOKUP }}">{{ $estados->LOO_DESCRIPCION }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <button style="margin-top:23px" type="button" id="buscarOrdCliente" class="btn btn-primary" data-toggle="tooltip" title="Buscar" data-container="body">Buscar</button>
        </div>
      </div>

      <div class="box-footer">
        <div class="busqueda"></div>
      </div>
           
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="box box-info">

      <div class="box-header with-border">
        <h3 class="box-title">Lista de Ordenes de Servicio</h3>
      </div>
        <div class="resultado"></div>
      <div class="box-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped table_" data-ruta="cambioEstadoEmp">
            <thead>
                <tr>
                    <th class="centro">Estado</th>
                    <th class="centro">Dirección</th>
                    <th class="centro">Fecha</th>
                    <th class="centro">Horas</th>
                    <th class="centro">Asignado a</th>
                    <th class="centro">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ordenServicio as $orden)
                    <tr class="temporal">
                        <td>{{ $orden->estado_orden }}</td>
                        <td>{{ $orden->ORD_INM_IDINMUEBLE }}</td>
                        <td>{{ date_format(new DateTime($orden->ORD_INICIOORDEN), 'Y-m-d H:i') }}</td>
                        <td>
                          <?php 
                            $start_date = new DateTime($orden->ORD_INICIOORDEN);
                            $since_start = $start_date->diff(new DateTime($orden->ORD_FINORDEN));
                            echo $since_start->h.' H ';
                          ?>                          
                        </td>
                        <td>{{ $orden->name }} {{ $orden->USR_APELLIDOS }}</td>

                        <td class="centro" style="width: 125px;">
                            @if($orden->estado_orden != "FINALIZADO")
                              @if($orden->estado_orden == "ESPERADOREQUERIMIENTOS")
                                <a class="btn btn-primary btn-sm borrar" href="ordenCliente/{{ $orden->ORD_IDORDEN }}/edit" role="button" data-toggle="tooltip" title="" data-placement="top" data-original-title="Modificar Orden de Servicio" data-container="body">
                                  <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                              @endif
                              @if($orden->ORD_INICIOORDEN > $diaSiguiente)
                              <button class="btn btn-danger btn-sm anularOrdencliente " data-id="{{ $orden->ORD_IDORDEN }}" data-email="{{ $orden->email }}" data-nombre="{{ $orden->name }} {{ $orden->USR_APELLIDOS }}" data-dir="{{ $orden->ORD_INM_IDINMUEBLE }}" data-toggle="tooltip" data-placement="top" data-original-title="Anular la Orden de Servicio">
                                <span class="glyphicon glyphicon-remove"></span>
                              </button>
                              @endif
                            @endif
                            @if($orden->estado_orden == "FINALIZADO" && $orden->ORD_CLI_CALIFICO != True  )
                                <a class="btn btn-success btn-sm" href="comenzarOrdenCliente/{{ $orden->ORD_IDORDEN }}" data-original-title="Calificar orden">
                                  Calificar
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <div class="box-footer">
        
      </div>
           
    </div>
  </div>
</div>


@endsection

