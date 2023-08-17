<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\GiroNegocio;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        $giroNegocios = GiroNegocio::all();
        $paises = City::all();

        return view('auth.register', compact('paises','giroNegocios'));
    }

    public function store(Request $request){
        // dd($request->get('name'));

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'direccion' => 'required',
            'telefono' => 'required',
            'eslogan' => 'required',
            'descripcion' => 'required',
            'id_giro_negocio' => 'required',
            'url_logo' => 'required',
            'id_pais' => 'required',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'eslogan' => $request->eslogan,
            'descripcion' => $request->descripcion,
            'id_giro_negocio' => $request->id_giro_negocio,
            'url_logo' => $request->url_logo,
            'id_pais' => $request->id_pais,
            'password' => $request->password,
        ]);

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        auth()->attempt($request->only('email','password'));

        return redirect('/');
    }
}
