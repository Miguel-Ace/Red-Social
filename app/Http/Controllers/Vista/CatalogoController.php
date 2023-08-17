<?php

namespace App\Http\Controllers\Vista;

use App\Http\Controllers\Controller;
use App\Models\CategoriaGiro;
use App\Models\City;
use App\Models\DetalleProductosEmpresa;
use App\Models\GiroNegocio;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    // ============Views============
    public function pais(){
        $paises = City::all();
        return view('catalogos.pais', compact('paises'));
    }
    public function DS(){
        $detalle_servcio = DetalleProductosEmpresa::all();
        return view('catalogos.detalle_servicio', compact('detalle_servcio'));
    }
    public function CG(){
        $categoria_giro = CategoriaGiro::all();
        return view('catalogos.categoria_giro', compact('categoria_giro'));
    }
    public function NG(){
        $negocio_giro = GiroNegocio::all();
        return view('catalogos.negocio_giro', compact('negocio_giro'));
    }


    // ============Create===========
    public function storePais(Request $request){
        $datos = $request->except('_token');
        City::insert($datos);

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }

    public function storeDS(Request $request){
        $datos = $request->except('_token');
        DetalleProductosEmpresa::insert($datos);

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }

    public function storeCG(Request $request){
        $datos = $request->except('_token');
        CategoriaGiro::insert($datos);

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }

    public function storeNG(Request $request){
        $datos = $request->except('_token');
        GiroNegocio::insert($datos);

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }

    // ============Edit==============
    public function updatePais(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        City::where('id','=',$id)->update($datos);
        // dd($id);
        return redirect()->back()->with('mensaje','Actualizado Exitosamente');
    }

    public function updateDS(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        DetalleProductosEmpresa::where('id','=',$id)->update($datos);
        // dd($id);
        return redirect()->back()->with('mensaje','Actualizado Exitosamente');
    }

    public function updateCG(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        CategoriaGiro::where('id','=',$id)->update($datos);
        // dd($id);
        return redirect()->back()->with('mensaje','Actualizado Exitosamente');
    }

    public function updateNG(Request $request, $id)
    {
        $datos = $request->except('_token','_method');
        GiroNegocio::where('id','=',$id)->update($datos);
        // dd($id);
        return redirect()->back()->with('mensaje','Actualizado Exitosamente');
    }


    // =============Delete============
    public function destroyPais($id)
    {
        City::destroy($id);
        return redirect()->back()->with('borrar','Borrado Exitosamente');
    }

    public function destroyDS($id)
    {
        DetalleProductosEmpresa::destroy($id);
        return redirect()->back()->with('borrar','Borrado Exitosamente');
    }

    public function destroyCG($id)
    {
        CategoriaGiro::destroy($id);
        return redirect()->back()->with('borrar','Borrado Exitosamente');
    }

    public function destroyNG($id)
    {
        GiroNegocio::destroy($id);
        return redirect()->back()->with('borrar','Borrado Exitosamente');
    }
}
