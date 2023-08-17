@extends('plantillas.plantilla')

@section('ubicar-pagina')
    <p>Perfil</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Selecciona - Itoken</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('perfil/'.$usuario->id)}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div>
                <label for="name">Empresa:</label>
                <input type="text" id="name" name="name" value="{{$usuario->name}}">
            </div>

            <div>
                <label for="email">Correo:</label>
                <input type="email" id="email" name="email" value="{{$usuario->email}}">
            </div>

            <div>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" value="{{$usuario->direccion}}">
            </div>

            <div>
                <label for="telefono">Teléfono:</label>
                <input type="number" id="telefono" name="telefono" value="{{$usuario->telefono}}">
            </div>

            <div>
                <label for="eslogan">Eslogan:</label>
                <input type="text" id="eslogan" name="eslogan" value="{{$usuario->eslogan}}">
            </div>

            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion">{{$usuario->descripcion}}</textarea>
            </div>
        </div>

        <div class="informacion-general">
            <p><span>Precio:</span> <span class="span-precio"></span> <span class="span-haber"></span></p>
            <p><span>Descripción:</span> <span class="span-descripción"></span></p>
            <p class="span-saldo"></p>
        </div>

        <button class="btn-enviar" type="submit">Agregar</button>
    </form>
@endsection

    <script>
    </script>

