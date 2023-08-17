@extends('plantillas.plantilla')

@section('ubicar-pagina')
    <p>Itoken</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Selecciona - Itoken</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('/')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div class="ocultar">
                <label for="fecha_hora">Fecha:</label>
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{date('Y-m-d H:i:s')}}">
            </div>

            <div class="ocultar">
                <label for="id_mi_empresa">Mi empresa:</label>
                <input type="number" id="id_mi_empresa" name="id_mi_empresa" value="{{$user->id}}">
            </div>

            <div >
                <label for="id_empresa">Empresa: @error('id_empresa') <span style="color: red">{{$message}}</span> @enderror</label>
                <select name="id_empresa" id="id_empresa">
                    <option value="" disabled selected>Seleccione la empresa</option>
                    @foreach ($empresas as $empresa)
                        <option  value="{{$empresa->id}}">{{$empresa->name}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="id_producto_servicio">Producto/Servicio: @error('id_producto_servicio') <span style="color: red">{{$message}}</span> @enderror</label>
                <select name="id_producto_servicio" id="id_producto_servicio">
                    <option value="" disabled selected>Seleccione servicio</option>
                    @foreach ($productos as $producto)
                        <option value="{{$producto->id}}" data-idEmpresa="{{$producto->id_empresa}}" style="display: none">{{$producto->producto_servicio}}</option>
                    @endforeach
                </select>
            </div>

            <div class="ocultar">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio">
            </div>

            <div>
                <label for="cantidad">Cantidad: @error('cantidad') <span style="color: red">{{$message}}</span> @enderror</label>
                <input type="number" id="cantidad" name="cantidad" min="1" value="{{old('cantidad')}}">
            </div>
            <div class="ocultar">
                <label for="saldo">Saldo:</label>
                <input type="number" id="saldo" name="saldo" step="0.01">
            </div>
            <div class="ocultar">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
            <div>
                <label for="notas">Notas:</label>
                <textarea id="notas" name="notas"></textarea>
            </div>

            <div class="ocultar">
                <label for="debe">Debe:</label>
                <input type="text" id="debe" name="debe" value="--">
            </div>

            <div class="ocultar">
                <label for="haber">Haber:</label>
                <input type="number" id="haber" name="haber" >
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

@section('tabla-empresa')
    <div class="titulo-tabla-empresa activo">Detalle</div>
    <table class="mostrarTabla">
        <thead>
            <tr>
                {{-- <th>Número</th> --}}
                <th>Fecha</th>
                <th>Empresa</th>
                <th>Producto/Servicio</th>
                <th>Debe</th>
                <th>Haber</th>
                <th>Saldo</th>
                <th>Descripción/Notas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itokens as $itoken)
                @if ($itoken->id_mi_empresa === $user->id)
                    <tr>
                        <td>{{$itoken->fecha_hora}}</td>
                        <td>{{$itoken->empresas->name}}</td>
                        <td>{{$itoken->productoServicios->producto_servicio}}</td>
                        <td>{{$itoken->debe}}</td>
                        <td>{{$itoken->haber}}</td>
                        <td>{{$itoken->saldo}}</td>
                        <td>{{$itoken->descripcion}}</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        //todos los tr para sacar el ultimo saldo
        const tbody = document.querySelectorAll('tbody tr:last-child')

        //boton submit del form
        const btnEnviar = document.querySelector('.btn-enviar')

        // informacion inferior del formulario
        const informacionGeneral = document.querySelector('.informacion-general')
        const spanPrecio = document.querySelector('.span-precio')
        const spanDescripción = document.querySelector('.span-descripción')
        const spanSaldo = document.querySelector('.span-saldo')
        const spanHaber = document.querySelector('.span-haber')

        // Hagarrando valor de inputs
        const empresa = document.querySelector('#id_empresa')
        const productoServicio = document.querySelector('#id_producto_servicio')
        const cantidad = document.querySelector('#cantidad')
        const precio = document.querySelector('#precio')
        const saldo = document.querySelector('#saldo')
        const descripcion = document.querySelector('#descripcion')
        const haber = document.querySelector('#haber')

        let sumarPrecio = 0

        // Recorriendo todos los productos con js
        const productos = JSON.parse('{!! json_encode($productos) !!}')


        const optionEmpresa = empresa.querySelectorAll('option')

        optionEmpresa.forEach(item => {
            if (item.value == '{!! $user->id !!}') {
                item.style = 'display:none'
            }
        })

        // Bloquear el btn submit si hay datos vacios
        empresa.addEventListener('change',() => {
            comprobarDatos()
        })
        productoServicio.addEventListener('change',() => {
            comprobarDatos()
        })
        cantidad.addEventListener('click',() => {
            comprobarDatos()
            saldo.value = sumarPrecio - haber.value
        })
        cantidad.addEventListener('change',() => {
            comprobarDatos()
            if (precio.value) {
                haber.value = precio.value * cantidad.value
                spanHaber.textContent = haber.value
                if (parseInt(spanHaber.textContent) > sumarPrecio) {
                    spanHaber.style = 'background-color: red; padding:1rem; color:white'
                }else{
                    spanHaber.style = ''
                }
            }
        })
        
        comprobarDatos()
        function comprobarDatos() {
            if ((empresa.value !== '' && haber.value <= sumarPrecio) && (productoServicio.value !== '' && cantidad.value !== '')) {
                btnEnviar.classList.remove('activo')
                btnEnviar.disabled = false;
            }else{
                btnEnviar.classList.add('activo')
                btnEnviar.disabled = true;
            }
        }
        
        // Saber ultimo saldo
        tbody.forEach(tr => {
            const sacandoUltimoSaldo = parseInt(tr.querySelector('td:nth-child(6)').textContent)
            spanSaldo.textContent = `$ ${sacandoUltimoSaldo}`
            sumarPrecio = sacandoUltimoSaldo
            saldo.value = sacandoUltimoSaldo
        });


        // dar producto o servicio según la empresa
        empresa.addEventListener('change', () => {
            // valor del input empresa
            const idEmpresa = empresa.value

            // Seleccionar los options de productos o servicios
            const options = productoServicio.querySelectorAll('option')
            
            // recorrer todos los options de productos o servicios para saber cual se mostrará según la empresa
            options.forEach(option => {
                const valorIdEmpresa = option.getAttribute('data-idEmpresa')
                if (idEmpresa != valorIdEmpresa) {
                    option.style = 'display:none'
                    productoServicio.value = ''
                    precio.value = ''
                    spanPrecio.textContent = ''
                    spanDescripción.textContent = ''
                    spanHaber.textContent = ''
                    informacionGeneral.classList.remove('activo')
                }else{
                    option.style = ''
                }
            })
        })


        // dar precio según los productos
        productoServicio.addEventListener('change', () => {
            informacionGeneral.classList.add('activo')

            const idProductoServicio = productoServicio.value
            const idEmpresa = empresa.value

            productos.forEach(producto => {
                const id = producto.id
                const id_empresa = producto.id_empresa
                const producto_servicio = producto.producto_servicio
                const descripcionProducto = producto.descripcion
                const precioProducto = parseInt(producto.precio)
                const tipo = producto.tipo

                if (id == idProductoServicio) {
                    precio.value = precioProducto
                    descripcion.value = descripcionProducto
                    haber.value = precioProducto

                    spanPrecio.textContent = precioProducto
                    spanDescripción.textContent = descripcionProducto
                    spanHaber.textContent = precioProducto
                    spanHaber.style = ''
                    cantidad.value = ''
                    comprobarDatos()
                }
            });
        })
    </script>
@endsection

