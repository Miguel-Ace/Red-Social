@extends('plantillas.plantilla')
    @vite(['resources/sass/modal.scss','resources/js/modal.js','resources/js/pais.js'])

@section('ubicar-pagina')
    <p>Giro Negocio</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Agregar - negocio giro</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('/negocio_giro')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div>
                <label for="giro_negocio">Negocio Giro:</label>
                <input type="text" id="giro_negocio" name="giro_negocio" value="">
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
                <th>Negocio Giro</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($negocio_giro as $ng)
                <tr>
                    <td>{{$ng->id}}</td>
                    <td>{{$ng->giro_negocio}}</td>
                    <td class="modificadores-icon">
                        <button type="button" class="btn btn-success btn-editar" data-toggle="modal" data-target="#exampleModalCenter" id-ng="{{$ng->id}}" valor-ng="{{$ng->giro_negocio}}">
                            <ion-icon name="pencil-outline"></ion-icon>
                        </button>

                        |

                        <form class="btn-borrar" onclick="return confirm('¿Estás Seguro de borrarlo?')"  method="post" id-ng="{{$ng->id}}">
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
        const inputng = document.querySelector('#giro_negocio-modal')
        const input2ng = document.querySelector('#giro_negocio')
        const btnEnviar = document.querySelector('.btn-enviar')

        btnEnviar.classList.toggle('activo')
        btnEnviar.disabled = true

        input2ng.addEventListener('change', () => {
            if (input2ng.value.length > 3) {
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
                contenidoModal.setAttribute('action', `negocio_giro/${itemEditar.getAttribute('id-ng')}`)
                inputng.value = itemEditar.getAttribute('valor-ng')
            }

            itemBorrar.setAttribute('action',`negocio_giro/${itemBorrar.getAttribute('id-ng')}`)
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
                            <label for="giro_negocio">Negocio Giro</label>
                            <input type="text" name="giro_negocio" id="giro_negocio-modal">
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