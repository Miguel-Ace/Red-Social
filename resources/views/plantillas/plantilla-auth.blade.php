<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/sass/plantilla-auth.scss'])
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="contenedor">
        <div class="formulario">
            {{-- <div class="logo-rokbit">
                <img src="{{asset('img/logo-ROKBIT.png')}}" alt="">
            </div> --}}
            @yield('form')
        </div>

        <div class="welcome">
            <p class="text-titulo">Bienvenido</p>
            <ion-icon name="people-circle-outline"></ion-icon>
            <p class="text-tienes-cuenta">¿Tienes cuenta?</p>
            @yield('pregunta-auth')
            <p class="text-footer">Page Create for Beesy {{date("Y")}}</p>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>