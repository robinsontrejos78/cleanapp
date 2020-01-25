<?php

namespace App\Http\Controllers;

use App\Http\Requests\creararticuloRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Inventario;
use App\Articulo;
use Auth;
use DB;

class InventarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function articulo_index($id, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idInm, FILTER_VALIDATE_INT)) abort(404);

        $inventarios = Inventario::join('ARTICULOS', 'INV_ART_IDARTICULO', '=', 'ART_IDARTICULO')
                    ->where('INV_INM_IDINMUEBLE', $idInm)->get();

        return view('inventarios.index', compact('id', 'inventarios', 'idInm'));
    }

    public function articulo_create($id, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idInm, FILTER_VALIDATE_INT)) abort(404);
       // dd($id, $idInm);

        $articulos = Articulo::all()->where('ART_EMP_IDEMPRESA', Session::get('idEmpresa'));
        return view('inventarios.articulo_create', compact('articulos', 'id', 'idInm'));
    }

    public function articulo_store(creararticuloRequest $request, $id, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idInm, FILTER_VALIDATE_INT)) abort(404);

        $igual_arts = DB::table('ARTICULOS')->select('ART_NOMBRE')
        ->where('ART_EMP_IDEMPRESA',  Session::get('idEmpresa'))->where('ART_NOMBRE', $request->nombre)->first();

        if (!$igual_arts) {
            $articulo = new Articulo();
            $articulo->ART_NOMBRE        = $request->get('nombre');
            $articulo->ART_EMP_IDEMPRESA = Session::get('idEmpresa');
            $articulo->save();
            
            return redirect('articulo_create/'.$id.'/'.$idInm)->with('message', 'El Articulo se ha Creado');
        }

        return redirect('articulo_create/'.$id.'/'.$idInm)->with('message1', 'El Articulo ya existe');

    }

    public function articulo_edit($id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $articulo = Articulo::find($id);
        return view('inventarios.articulo_edit', compact('id', 'articulo'));
    }

    public function articulo_update(Request $request, $id)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT)) abort(404);

        $articulo = Articulo::find($id);
        $articulo->ART_NOMBRE = $request->get('nombre');
        $articulo->save();

        return redirect('propiedad')->with('message', 'El Articulo ha sido modificado');
    }

    public function estado_articulo()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $EstadoA = Articulo::where('ART_IDARTICULO', '=', $id)->update(['ART_ESTADO' => $estado]);
    }

    public function buscar_articulo1()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $nombre_articulo = $_POST['nombre_articulo'];
        $idInm           = $_POST['idInm'];

        $busqueda_art1   = array();

        $nombre_articulo ? $busqueda_art1 += array(0 => array('ART_NOMBRE', 'like', '%'.$nombre_articulo.'%') ) : null;

        $articulos = DB::table('ARTICULOS')
                ->leftjoin('INVENTARIOS', 'INV_ART_IDARTICULO', '=', 'ART_IDARTICULO')
                ->where([
                    [$busqueda_art1],
                    ['ART_EMP_IDEMPRESA', Session::get('idEmpresa')],
                    ['ART_ESTADO', 1]
                ])->get();

        return view('inventarios.insert_BuscArticulos1', compact('articulos', 'idInm'));

    }

    public function buscar_articulo2()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $nombre_articulo = $_POST['nombre_articulo'];
        $busqueda_art2   = array();

        $nombre_articulo ? $busqueda_art2 += array(0 => array('ART_NOMBRE', 'like', '%'.$nombre_articulo.'%') ) : null;

        $articulos = DB::table('ARTICULOS')
                ->where([
                    [$busqueda_art2],
                    ['ART_EMP_IDEMPRESA', Session::get('idEmpresa')]
                ])->get();

        return view('inventarios.insert_BuscArticulos2', compact('articulos'));

    }

    public function guardar_inv()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $idInm = $_POST['idInm'];
        $id    = $_POST['id'];

        $inventario = new Inventario();
        $inventario->INV_INM_IDINMUEBLE = $idInm;
        $inventario->INV_ART_IDARTICULO = $_POST['idart'];
        $inventario->INV_CANTIDAD       = $_POST['cantidad_Art'];
        $inventario->save();

        $inventarios = Inventario::join('ARTICULOS', 'INV_ART_IDARTICULO', '=', 'ART_IDARTICULO')
                    ->where('INV_INM_IDINMUEBLE', $idInm)->get();

        return view('inventarios.insert_Inventario', compact('inventarios', 'idInm', 'id'));
    }

    public function estado_articuloInv()
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        $id      = $_POST["id"];
        $estado  = $_POST["estado"];

        $EstadoA = Inventario::where('INV_IDINVENTARIO', '=', $id)->update(['INV_ESTADO' => $estado]);
    }

    public function articuloInv_edit($id, $idProp, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idProp, FILTER_VALIDATE_INT) || !filter_var($idInm, FILTER_VALIDATE_INT)) abort(404);

        $inventario = Inventario::find($id);
        return view('inventarios.articuloInv_edit', compact('id', 'inventario', 'idProp', 'idInm'));
    }

    public function articuloInv_update(Request $request, $id, $idProp, $idInm)
    {
        if (!Auth::user()->hasRole('Administrador')) return abort(403);

        if (!filter_var($id, FILTER_VALIDATE_INT) || !filter_var($idProp, FILTER_VALIDATE_INT) || !filter_var($idInm, FILTER_VALIDATE_INT)) abort(404);

        $inventario = Inventario::find($id);
        $inventario->INV_CANTIDAD = $request->get('cantidad');
        $inventario->save();

        return redirect('articulo_index/'.$idProp.'/'.$idInm)->with('message', 'El Inventario ha sido modificado');
    }
}
