<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\GiroNegocio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index(){
        $giroNegocios = GiroNegocio::all();
        $paises = City::all();

        return view('auth.login', compact('paises','giroNegocios'));
    }

    public function store(Request $request){
        // dd($request->get('name'));

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('mensaje','Credenciales Incorrectas');
        }

        return redirect('/');
    }
}
