@extends('plantillas.plantilla-auth')

@section('form')
    <p>Regístro</p>

    <form class="formulario-register" action="{{url('/register')}}" method="post">
        @csrf
        <div class="contenedor-inputs">
            <div class="inputs">
                <label for="name">@error('name') <span class="text-error">{{$message}}</span> @enderror Nombre</label>
                <input type="text" id="name" name="name" value="{{old('name')}}">
            </div>
            <div class="inputs">
                <label for="email">@error('email') <span class="text-error">{{$message}}</span> @enderror Correo</label>
                <input type="email" id="email" name="email" value="{{old('email')}}">
            </div>
            <div class="inputs">
                <label for="direccion">@error('direccion') <span class="text-error">{{$message}}</span> @enderror Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{old('direccion')}}">
            </div>
            <div class="inputs">
                <label for="telefono">@error('telefono') <span class="text-error">{{$message}}</span> @enderror Teléfono</label>
                <input type="number" id="telefono" name="telefono" value="{{old('telefono')}}">
            </div>
            <div class="inputs">
                <label for="eslogan">@error('eslogan') <span class="text-error">{{$message}}</span> @enderror Eslogan</label>
                <input type="text" id="eslogan" name="eslogan" value="{{old('eslogan')}}">
            </div>
            <div class="inputs textarea">
                <label for="descripcion">@error('descripcion') <span class="text-error">{{$message}}</span> @enderror Descripción</label>
                <textarea name="descripcion" id="descripcion">{{old('descripcion')}}</textarea>
            </div>
            <div class="inputs">
                <label for="id_giro_negocio">@error('id_giro_negocio') <span class="text-error">{{$message}}</span> @enderror Giro Negocio</label>
                <select name="id_giro_negocio" id="id_giro_negocio">
                    @foreach ($giroNegocios as $giroNegocio)
                        <option {{old('id_giro_negocio') == $giroNegocio->id ? 'selected' : ''}} value="{{$giroNegocio->id}}">{{$giroNegocio->giro_negocio}}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputs">
                <label for="url_logo">@error('url_logo') <span class="text-error">{{$message}}</span> @enderror Logo</label>
                <input type="text" id="url_logo" name="url_logo" value="{{old('url_logo')}}">
            </div>
            <div class="inputs">
                <label for="id_pais">@error('id_pais') <span class="text-error">{{$message}}</span> @enderror País</label>
                <select name="id_pais" id="id_pais">
                    @foreach ($paises as $pais)
                        <option {{old('id_pais') == $pais->id ? 'selected' : ''}} value="{{$pais->id}}">{{$pais->pais}}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputs">
                <label for="password">@error('password') <span class="text-error">{{$message}}</span> @enderror Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div class="inputs">
                <label for="password_confirmation">@error('password_confirmation') <span class="text-error">{{$message}}</span> @enderror Repetir Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>
        </div>

        <div class="acciones">
            <a href=""><i class="fas fa-handshake"></i> Recuperar Contraseña</a>
            <button type="submit">Guardar</button>
        </div>
    </form>
@endsection

@section('pregunta-auth')
    <a href="{{url('/login')}}">Iniciar Sesión</a>
@endsection