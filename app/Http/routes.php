<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('empresa', 'EmpresaController');

Route::resource('user', 'UserController');

Route::resource('formprofe', 'formularioController@formprof');

Route::resource('propiedad', 'PropiedadController');

Route::resource('ciudad', 'CiudadController');

Route::resource('orden', 'OrdenController');

Route::resource('ordenCliente', 'OrdenClienteController');

Route::resource('ordenP', 'OrdenpersonaController');

Route::resource('historial', 'OrdenpersonaController@historialorden');

Route::resource('inventario', 'ReportesinventarioController');

Route::resource('terminos', 'formularioController@showterminos');

Route::resource('habeas', 'formularioController@showhabeas');

Route::resource('reporte', 'ReportesinventarioController@reporte_index');

Route::resource('inscripcion', 'formularioController@mostrarprof');

Route::resource('orden', 'OrdenController');

Route::resource('vercalificacion', 'OrdenpersonaController@calificaciones');

//Buscador de empresas ajax
Route::post('buscarEmp', 'EmpresaController@buscarEmpresa');

//Envio de formulario de profesionales
Route::post('inscripcionprof', 'formularioController@createprof');

//Buscador de usuarios ajax
Route::post('buscarUsu', 'UserController@buscarUsuario');

Route::post('descartarregistro', 'formularioController@descartarins');

//Buscar datos de profesional que se inscribio en la plataforma
Route::post('buscarprof', 'formularioController@mostrardatosprof');


//Cambio estado Usuario
Route::post('cambioEstadoUsu', 'UserController@cambioEstadoUsuario');

//Cambio estado Empresa
Route::post('cambioEstadoEmp','EmpresaController@cambioEstadoEmpresa');

//Cambio estado Propiedad
Route::post('estadoPropiedad','PropiedadController@estadoPropiedad');

//Cambio estado Inmueble
Route::post('estadoInmueble','InmuebleController@estadoInmueble');

//Mostrar Usuario en modal
Route::get('show/{id}', 'UserController@showUsuarios');

//index inmueble
Route::get('inmueble_index/{id}', 'InmuebleController@index');

//create inmueble
Route::get('inmueble_create/{id}', 'InmuebleController@create');

//create inmueble
Route::post('inmueble_store/{id}', 'InmuebleController@store');

//edit inmueble
Route::get('inmueble_edit/{id}/{idpropiedad}', 'InmuebleController@edit');

//update inmueble
Route::put('inmueble_update/{id}/{idpropiedad}', 'InmuebleController@update');

//show inmueble
Route::get('showInmueble/{id}', 'InmuebleController@show');

//Valida la empresa a la que pertenece un usuario para el logueo
Route::post('validaEmpresa', 'Auth\AuthController@validaEmpresaUsuario');

//index personas de aseo, mantenimiento, inventario
Route::get('indexPersona', 'UserController@indexPersonas');

//crear persona de aseo, mantenimiento, inventario
Route::get('createPersona', 'UserController@createPer');

//store persona de aseo, mantenimiento, inventario
Route::post('storePersona', 'UserController@storePersonas');

//Buscador de personas ajax
Route::post('buscarPer', 'UserController@buscarPersona');

//Mostrar Persona en modal
Route::get('showPersona/{id}', 'UserController@showPersonas');

//Editar persona (aseo, inventario, mantenimiento
Route::get('editPer/{id}', 'UserController@editPersona');

//Store persona (aseo, inventario, mantenimiento
Route::put('updatePer/{id}', 'UserController@updatePersonas');

//articulo create
Route::get('articulo_create/{id}/{idInm}', 'InventarioController@articulo_create');

//articulo store
Route::get('articulo_store/{id}/{idInm}', 'InventarioController@articulo_store');

//articulo edit
Route::get('edit_Articulo/{id}', 'InventarioController@articulo_edit');

//articulo update
Route::get('articulo_update/{id}', 'InventarioController@articulo_update');

//articulo index
Route::get('articulo_index/{id}/{idInm}','InventarioController@articulo_index');

//Cambio estado articulo
Route::post('estado_articulo','InventarioController@estado_articulo');

//Cambio estado articulo del inventario
Route::post('estado_articuloInv','InventarioController@estado_articuloInv');

//articulo edit inventario
Route::get('edit_Inventario/{id}/{idProp}/{idInm}', 'InventarioController@articuloInv_edit');

//articulo edit Inventario General
Route::get('edit_Art/{id}/{idProp}/{idInm}', 'ReportesinventarioController@articulo_edit');

//articulo update
Route::get('articuloInv_update/{id}/{idProp}/{idInm}', 'InventarioController@articuloInv_update');

//buscar articulo _create
Route::post('buscar_articulo2', 'InventarioController@buscar_articulo2');

//buscar articulo inventario
Route::post('buscar_articulo1', 'InventarioController@buscar_articulo1');

//guardar articulo en inventario
Route::post('guardar_inv', 'InventarioController@guardar_inv');

//update personas
Route::put('updatePer/{id}', 'UserController@updatePersonas');


//Buscador de Ordenes ajax
Route::post('buscarOrd', 'OrdenController@buscarOrdenes');

//llena select con tipos de personas ajax
Route::post('selectTipoper', 'OrdenController@selectTipoper');

//Pagar ordenes de servicio
Route::post('pagarOrden', 'OrdenController@pagarOrdenes');

//Anular Ordenes de Servicio
Route::post('anularOrden', 'OrdenController@anularOrdenes');

//Comenzar orden de trabajo
Route::get('comenzarOrden/{idorden}', 'OrdenpersonaController@comenzarOrden');

//Comenzar orden de trabajo
Route::get('iniciarOrden/{idorden}', 'OrdenpersonaController@comenzarOrden');

//Guardar evidencia de mantenimiento
Route::post('guardarEvidencia', 'OrdenpersonaController@guardarEvidencias');

//ruta para finalizar ordenes de servicio
Route::get('finalizarOrden/{idor}', 'OrdenpersonaController@finalizarOrdenes');

//ruta para finalizar ordenes de servicio
Route::post('calificarorden', 'OrdenpersonaController@calificarorden');


//buscar ciudad
Route::post('buscarCiu', 'CiudadController@buscarCiudad');

//ventana modal novedad checkin
Route::post('novedadCheckin', 'OrdenpersonaController@novedadCheckin');

//guardar novedad de inventario aseo
Route::post('guardarNovedad', 'OrdenpersonaController@guardarNovedades');

//continuar orden de aseo despues de checkin
Route::get('continuarOrden/{idor}', 'OrdenpersonaController@continuarOrdenes');

//continuar con orden despues de evidencias de aseo
Route::get('checkoutOrden/{idor}', 'OrdenpersonaController@checkoutOrdenes');

//ordenes sin pagar
Route::get('ordenesSinPagar', 'OrdenpersonaController@ordenesSinPagar');

//evidencias de las ordenes de servicio
Route::get('evidenciasOrden/{idor}', 'OrdenController@evidenciasOrdenes');

//ver imagenes evidencias modal
Route::post('verImagenEvi', 'OrdenController@verImagenEvidencia');

Route::get('ordenesSinPagar', 'OrdenpersonaController@ordenesSinPagar');

//modal imagen novedades
Route::post('imagenNovedad', 'OrdenController@imagenNovedades');

//funalizar novedad
Route::post('finalizarNovedad', 'OrdenController@finalizarNovedades');

//guardar imagen novedad
Route::post('guardarImagenNovedad', 'OrdenpersonaController@guardarImagenNovedades');

//buscar articulo inventario general
Route::post('buscararti', 'ReportesinventarioController@buscarInventario');

//cambio estado ciudad
Route::post('cambioEstadoCiudad', 'CiudadController@cambioEstadoCiudades');

//buscar reporte
Route::post('buscarreporte', 'ReportesinventarioController@buscareporte');

//agenda de profesional de servicio
Route::get('visualizarAgenda/{id}/edit', 'AgendaprofController@edit');

Route::post('agergarItem', 'AgendaprofController@store');

//rutas para el cliente
Route::get('formcliente', 'clienteController@create');

Route::resource('cliente', 'clienteController');