@extends('plantillas.plantilla')
    @vite(['resources/sass/modal.scss','resources/js/modal.js','resources/js/pais.js'])

@section('ubicar-pagina')
    <p>Giro Categoria</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Agregar - Categoria giro</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('/categoria_giro')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div>
                <label for="categoria_giro">Categoria Giro:</label>
                <input type="text" id="categoria_giro" name="categoria_giro" value="">
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
                <th>Número</th>
                <th>Categoria Giro</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categoria_giro as $cg)
                <tr>
                    <td>{{$cg->id}}</td>
                    <td>{{$cg->categoria_giro}}</td>
                    <td class="modificadores-icon">
                        <button type="button" class="btn btn-success btn-editar" data-toggle="modal" data-target="#exampleModalCenter" id-cg="{{$cg->id}}" valor-cg="{{$cg->categoria_giro}}">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </button>

                        |

                        <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" id-cg="{{$cg->id}}">
                            @csrf
                            @method('DELETE')
                            <button><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        const btnSalirModal = document.querySelector('.btn-salir-modal')
        const cerrar = document.querySelector('.cerrar')
        const modal = document.querySelector('.modal')
        const botonesAccion = document.querySelectorAll('tbody tr')
        const contenidoModal = document.querySelector('.contenido-modal form')
        const inputcg = document.querySelector('#categoria_giro-modal')
        const input2cg = document.querySelector('#categoria_giro')
        const btnEnviar = document.querySelector('.btn-enviar')

        btnEnviar.classList.toggle('activo')
        btnEnviar.disabled = true

        input2cg.addEventListener('change', () => {
            if (input2cg.value.length > 3) {
                btnEnviar.classList.remove('activo')
                btnEnviar.disabled = false
                // console.log(true);
            }else{
                btnEnviar.classList.add('activo')
                btnEnviar.disabled = true
                // console.log(false);
            }
        })

        botonesAccion.forEach(item => {
            const itemEditar = item.querySelector('td:nth-child(3) .btn-editar')
            const itemBorrar = item.querySelector('td:nth-child(3) .btn-borrar')

            itemEditar.onclick = () => {
                modal.classList.toggle('ocultar')
                contenidoModal.setAttribute('action', `categoria_giro/${itemEditar.getAttribute('id-cg')}`)
                inputcg.value = itemEditar.getAttribute('valor-cg')
            }

            itemBorrar.setAttribute('action',`categoria_giro/${itemBorrar.getAttribute('id-cg')}`)
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
                <p class="titulo-modal">Editar País</p>
                <button class="btn-salir-modal">X</button>
            </div>

            <div class="contenido-modal">
                <form method="post">
                    @csrf
                    {{method_field('PATCH')}}

                    <div class="contenedor-input-modal">
                        <div>
                            <label for="categoria_giro">Categoria Giro</label>
                            <input type="text" name="categoria_giro" id="categoria_giro-modal">
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