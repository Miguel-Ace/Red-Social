@extends('plantillas.plantilla-auth')

@vite(['resources/js/login.js'])

@section('form')
    <p>Inicio de sesión</p>

    <form class="formulario-login" action="{{url('/login')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="email">@error('email') <span class="text-error">{{$message}}</span> @enderror Correo</label>
                <input type="email" id="email" name="email" value="{{old('email')}}">
            </div>
            <div class="inputs">
                <label for="password">@error('password') <span class="text-error">{{$message}}</span> @enderror Password</label>
                <input type="password" id="password" name="password">
            </div>
        </div>

        <div class="acciones">
            <a href=""><i class="fas fa-handshake"></i> Recuperar Contraseña</a>
            <button type="submit">Guardar</button>
        </div>
    </form>
@endsection

@section('pregunta-auth')
    <a href="{{url('/register')}}" class="btn-registro">Regístrate</a>
@endsection