<?php

namespace App\Http\Controllers\Vista;

use App\Http\Controllers\Controller;
use App\Models\DetalleProductosEmpresa;
use App\Models\Token;
use App\Models\Tokens_innovacion;
use App\Models\User;
use Illuminate\Http\Request;

class PrincipalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Parte itoken
    public function itoken(){
        $empresas = User::all();
        $productos = DetalleProductosEmpresa::all();
        $user = auth()->user();
        $itokens = Token::all();
        return view('itokens', compact('itokens','user','empresas','productos'));
    }

    public function store(Request $request){
        $datos = $request->except('_token');
        Token::insert($datos);

        // $ultimoDato = Token::where('id_empresa', $request->id_empresa)->latest()->first();
        $ultimoDato = Token::all();
        $arrSaldo = [];
        foreach ($ultimoDato as $saldo) {
            if ($saldo->id_mi_empresa == $request->id_empresa) {
                array_push($arrSaldo, $saldo->saldo);
            }
        }

        $ultimoSaldo = end($arrSaldo);

        $guardar = new Token();
        $guardar->fecha_hora = $request->fecha_hora;
        $guardar->id_mi_empresa = $request->id_empresa;
        $guardar->id_empresa = $request->id_empresa;
        $guardar->id_producto_servicio = $request->id_producto_servicio;
        $guardar->descripcion = $request->descripcion;
        $guardar->cantidad = $request->cantidad;
        $guardar->haber = "--";
        $guardar->debe = $request->haber;
        $guardar->saldo = $ultimoSaldo + $request->haber;
        $guardar->save();

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }


    // Parte token de innovacion
    public function tokenInnovacion(){
        $empresas = User::all();
        $user = auth()->user();
        $productos = DetalleProductosEmpresa::all();
        $Tinnovacion = Tokens_innovacion::all();
        return view('tokens-innovacion', compact('Tinnovacion','user','empresas','productos'));
    }

    public function StoreTokenInnovacion(Request $request){
        $datos = $request->except('_token');
        Tokens_innovacion::insert($datos);


        $ultimoDato = Tokens_innovacion::all();
        $arrSaldo = [];
        foreach ($ultimoDato as $saldo) {
            if ($saldo->id_mi_empresa == $request->id_empresa) {
                array_push($arrSaldo, $saldo->saldo);
            }
        }

        $ultimoSaldo = end($arrSaldo);
        
        $guardar = new Tokens_innovacion();
        // $guardar->fecha_hora = $request->fecha_hora;
        $guardar->id_mi_empresa = $request->id_empresa;
        $guardar->saldo = $ultimoSaldo + $request->cantidad;
        $guardar->save();

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }

    // Parte Administrador
    public function addTokenAdmin() {
        $empresas = User::all();
        $productos = DetalleProductosEmpresa::all();
        $user = auth()->user();
        $itokens = Token::all();
        return view('addTokenAdmin', compact('itokens','user','empresas','productos'));
    }

    public function storeAddTokenAdmin(Request $request){
        $datos = $request->except('_token');
        Token::insert($datos);

        return redirect()->back()->with('mensaje','Creado Exitosamente');
    }


    public function perfil(){
        $usuario = auth()->user();
        return view('perfil.perfil', compact('usuario'));
    }

    public function updatePerfil(Request $request, $id){

        $datos = $request->except('_token','_method');
        User::where('id','=',$id)->update($datos);
        return redirect()->back()->with('mensaje','Actualizado Exitosamente');
    }
}
