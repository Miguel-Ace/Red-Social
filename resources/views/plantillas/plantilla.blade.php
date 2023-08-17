<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/cd197f289d.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/plantilla.scss','resources/js/plantilla.js'])
</head>
<body>
    <div class="contenedor">
      @if (session('mensaje'))
        <div class="mensajes">
          <i class="fa-solid fa-check icon-listo"></i>
          <p>{{ session('mensaje') }}</p>
        </div>
        <script>
          const mensaje = document.querySelector('.mensajes'); // Cambiado de '.mensaje' a '.mensajes'
          mensaje.style.transform = 'translateX(0)';
          setTimeout(() => {
              mensaje.style.transform = 'translateX(100%)';
          }, 2000);
        </script>
      @endif

      @if (session('borrar'))
      <div class="mensajes">
        <i class="fa-solid fa-xmark icon-borrar"></i>
        <p>{{ session('borrar') }}</p>
      </div>
        <script>
          const mensaje = document.querySelector('.mensajes'); // Cambiado de '.mensaje' a '.mensajes'
          mensaje.style.transform = 'translateX(0)';
          setTimeout(() => {
              mensaje.style.transform = 'translateX(100%)';
          }, 2000);
        </script>
      @endif

        <header>
            <div class="ubicacion-logoRokbit">
                <div class="logo-rokbit">
                    <img src="{{asset('img/logo-ROKBIT.png')}}" alt="">
                </div>

                <div class="catalogo desktop">
                  <a href="/">Itoken</a>
                  <a href="{{url('/token-innovacion')}}">Token de innovacion</a>
                </div>

                <div class="ubicacion-pagina">
                    @yield('ubicar-pagina')
                </div>
            </div>

            <div class="usuario">
                <div class="logo-empresa desktop">
                  @if (auth()->check())
                    <img src="{{auth()->user()->url_logo}}" alt="">
                    <p>{{auth()->user()->name}}</p>
                  @endif
                </div>
                <button class="btn-settins">+</button>

                <div class="datos-empresa">
                  <div class="logo-empresa2 mobile">
                    @if (auth()->check())
                      <img src="{{auth()->user()->url_logo}}" alt="">
                    @endif
                  </div>
                    <div class="mobile">
                      <a href="/">Itoken</a>
                      <a href="{{url('/token-innovacion')}}">Token de innovacion</a>
                    </div>
                    <a href="{{'/perfil'}}">Perfil <ion-icon name="person-circle-outline"></ion-icon></a>
                    <a href="{{url('/add-token-admin')}}">Admin <ion-icon name="build-outline"></ion-icon></a>
                    <a href="{{url('/assign')}}">Rol de Usuario <i class="fa-regular fa-address-book"></i></a>
                    <div class="container-catalogo">
                        <a href="#">Catálogo <ion-icon name="caret-forward-outline"></ion-icon></a>
                        <div class="list-catalogo">
                          <a href="{{url('/pais')}}">País <i class="fa-solid fa-earth-americas"></i></a>
                          <a href="{{url('/detalle_servcio')}}">Detalle Servicios <i class="fa-solid fa-bell-concierge"></i></a>
                          <a href="{{url('/categoria_giro')}}">Giro Categorias <i class="fa-solid fa-cloud"></i></a>
                          <a href="{{url('/negocio_giro')}}">Giro Negocios <i class="fa-solid fa-business-time"></i></a>
                        </div>
                    </div>
                    <a href="{{url('/logout')}}">Cerrar Sesión <ion-icon name="log-out-outline"></ion-icon></a>
                </div>
            </div>
        </header>

        <main>
            <div class="tablas-agregar">
                <div class="agregar">
                  @yield('agregar')
                </div>

                <div class="tabla-empresa">
                  @yield('tabla-empresa')                                 
                </div>
            </div>
        </main>

        <footer></footer>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>