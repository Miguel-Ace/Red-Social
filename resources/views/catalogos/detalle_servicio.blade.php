@extends('plantillas.plantilla')
    @vite(['resources/sass/modal.scss','resources/js/modal.js','resources/js/pais.js'])

@section('ubicar-pagina')
    <p>Detalle Producto/Servicio</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Agregar - producto/servicio</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('/detalle_servcio')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div class="ocultar">
                <label for="id_empresa">Empresa:</label>
                <input type="text" id="id_empresa" name="id_empresa" value="{{auth()->user()->id}}">
            </div>
            <div>
                <label for="producto_servicio">Producto/Servicio:</label>
                <input type="text" id="producto_servicio" name="producto_servicio" value="">
            </div>
            <div>
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="">
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
        </div>

        <button class="btn-enviar" type="submit">Agregar</button>
    </form>
@endsection

@section('tabla-empresa')
    <div class="titulo-tabla-empresa activo">Detalle</div>
    <table class="mostrarTabla">
        <thead>
            <tr>
                <th>Empresa</th>
                <th>Producto/Servicio</th>
                <th>Precio</th>
                <th>Descripción</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalle_servcio as $ds)
                @if ($ds->id_empresa == auth()->user()->id)
                    <tr>
                        <td>{{$ds->empresas->name}}</td>
                        <td>{{$ds->producto_servicio}}</td>
                        <td>{{$ds->precio}}</td>
                        <td>{{$ds->descripcion}}</td>
                        <td class="modificadores-icon">
                            <button type="button" class="btn btn-success btn-editar" data-toggle="modal" data-target="#exampleModalCenter" id-ds="{{$ds->id}}" valor-empresa="{{$ds->empresas->name}}" valor-servicio="{{$ds->producto_servicio}}" valor-precio="{{$ds->precio}}" valor-descripcion="{{$ds->descripcion}}">
                                <ion-icon name="pencil-outline"></ion-icon>
                            </button>

                            |

                            <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" id-ds="{{$ds->id}}">
                                @csrf
                                @method('DELETE')
                                <button><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        const btnSalirModal = document.querySelector('.btn-salir-modal')
        const cerrar = document.querySelector('.cerrar')
        const modal = document.querySelector('.modal')
        const botonesAccion = document.querySelectorAll('tbody tr')
        const contenidoModal = document.querySelector('.contenido-modal form')

        const inputEmpresa = document.querySelector('#id_empresa')
        const inputPs = document.querySelector('#producto_servicio-modal')
        const inputPrecio = document.querySelector('#precio-modal')
        const inputDescripcion = document.querySelector('#descripcion-modal')

        const producto2servicio = document.querySelector('#producto_servicio')
        const precio2 = document.querySelector('#precio')
        const input2Descripcion = document.querySelector('#descripcion')
        const btnEnviar = document.querySelector('.btn-enviar')

        btnEnviar.classList.toggle('activo')
        btnEnviar.disabled = true

        producto2servicio.addEventListener('change', comprobar)
        precio2.addEventListener('change', comprobar)
        input2Descripcion.addEventListener('change', comprobar)

        function comprobar() {
            const condicion1 = producto2servicio.value.length > 3
            const condicion2 = precio2.value.length > 0
            const condicion3 = input2Descripcion.value.length > 10

            // console.log(condicion1);
            // console.log(condicion2);
            // console.log(condicion3);

            if ((condicion1 && condicion2) && condicion3) {
                btnEnviar.classList.remove('activo')
                btnEnviar.disabled = false
                // console.log(true);
            }else{
                btnEnviar.classList.add('activo')
                btnEnviar.disabled = true
                // console.log(false);
            }
        }

        botonesAccion.forEach(item => {
            const itemEditar = item.querySelector('td:nth-child(5) .btn-editar')
            const itemBorrar = item.querySelector('td:nth-child(5) .btn-borrar')

            itemEditar.onclick = () => {
                modal.classList.toggle('ocultar')
                contenidoModal.setAttribute('action', `detalle_servcio/${itemEditar.getAttribute('id-ds')}`)
                inputEmpresa.value = itemEditar.getAttribute('valor-empresa')
                inputPs.value = itemEditar.getAttribute('valor-servicio')
                inputPrecio.value = itemEditar.getAttribute('valor-precio')
                inputDescripcion.value = itemEditar.getAttribute('valor-descripcion')
            }

            itemBorrar.setAttribute('action',`detalle_servcio/${itemBorrar.getAttribute('id-ds')}`)
            // console.log(itemBorrar);
        })

        btnSalirModal.onclick = () => {
            modal.classList.toggle('ocultar')
        }
        cerrar.onclick = () => {
            modal.classList.toggle('ocultar')
        }
    </script>
@endsection

    <!-- Modal Editar -->
    <div class="modal ocultar">
        <div class="container-modal">
            <div class="header-modal">
                <p class="titulo-modal">Editar Producto/Servicio</p>
                <button class="btn-salir-modal">X</button>
            </div>

            <div class="contenido-modal">
                <form method="post">
                    @csrf
                    {{method_field('PATCH')}}

                    <div class="contenedor-input-modal">
                        <div>
                            <label for="producto_servicio">Producto/Servicio:</label>
                            <input type="text" id="producto_servicio-modal" name="producto_servicio" value="">
                        </div>
                        <div>
                            <label for="precio">Precio:</label>
                            <input type="number" id="precio-modal" name="precio" value="">
                        </div>
                        <div>
                            <label for="descripcion">Descripción:</label>
                            <textarea id="descripcion-modal" name="descripcion"></textarea>
                        </div>
                    </div>

                    <div class="btns-acciones-modal">
                        <button class="guardar" type="submit">Guardar</button>
                        <span class="cerrar">Cerrar</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin Modal Editar --}}