@extends('plantillas.plantilla')

@vite(['resources/js/addTokenAdmin.js'])

@section('ubicar-pagina')
    <p>Administrador</p>    
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Agregar - Itoken</div>
    {{-- {{$user->id}} --}}
    <form action="{{url('/add-token-admin')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div class="ocultar">
                <label for="fecha_hora">Fecha:</label>
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{date('Y-m-d H:i:s')}}">
            </div>

            <div class="ocultar">
                <label for="id_mi_empresa">Mi empresa:</label>
                <input type="number" id="id_mi_empresa" name="id_mi_empresa" value="">
            </div>

            <div>
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
            <div class="ocultar">
                <label for="notas">Notas:</label>
                <textarea id="notas" name="notas"></textarea>
            </div>

            <div class="ocultar">
                <label for="debe">Debe:</label>
                <input type="text" id="debe" name="debe" >
            </div>

            <div class="ocultar">
                <label for="haber">Haber:</label>
                <input type="text" id="haber" name="haber" value="--">
            </div>
        </div>

        <div class="informacion-general">
            <p><span>precio:</span> <span class="span-precio"></span></p>
            <p><span>Saldo:</span> <span class="span-sald"></span></p>
            <p><span>Descripción:</span> <span class="span-descripción"></span></p>
        </div>

        <button class="btn-enviar" type="submit">Agregar</button>
    </form>
@endsection

@section('tabla-empresa')
    <div class="titulo-tabla-empresa activo">
        Detalle
        <select class="buscador-empresa">
            <option value=""></option>
            @foreach ($empresas as $empresa)
                <option value="{{$empresa->id}}">{{$empresa->name}}</option>
            @endforeach
        </select>
    </div>
    
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
                {{-- <tr style="display: none"> --}}
                <tr style="display: none">
                    <td style="display: none">{{$itoken->id}}</td>
                    <td style="display: none">{{$itoken->id_mi_empresa}}</td>
                    <td>{{$itoken->fecha_hora}}</td>
                    <td>{{$itoken->empresas->name}}</td>
                    <td>{{$itoken->productoServicios->producto_servicio}}</td>
                    <td>{{$itoken->debe}}</td>
                    <td>{{$itoken->haber}}</td>
                    <td>{{$itoken->saldo}}</td>
                    <td>{{$itoken->descripcion}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        //todos los tr para sacar el ultimo saldo :last-child
        const tbody = document.querySelectorAll('tbody tr')
        let idMax = 0
        let ultimoSaldo = 0
        //boton submit del form
        const btnEnviar = document.querySelector('.btn-enviar')

        // informacion inferior del formulario
        const informacionGeneral = document.querySelector('.informacion-general')
        const spanPrecio = document.querySelector('.span-precio')
        const spanDescripción = document.querySelector('.span-descripción')
        const spanSaldo = document.querySelector('.span-sald')
        // const spanHaber = document.querySelector('.span-haber')

        // Hagarrando valor de inputs
        const miEmpresa = document.querySelector('#id_mi_empresa')
        const empresa = document.querySelector('#id_empresa')
        const productoServicio = document.querySelector('#id_producto_servicio')
        const cantidad = document.querySelector('#cantidad')
        const precio = document.querySelector('#precio')
        const saldo = document.querySelector('#saldo')
        const descripcion = document.querySelector('#descripcion')
        const haber = document.querySelector('#haber')

        // Recorriendo todos los productos con js
        const productos = JSON.parse('{!! json_encode($productos) !!}')

        // Bloquear el btn submit si hay datos vacios
        empresa.addEventListener('change',() => {
            comprobarDatos()
            miEmpresa.value = empresa.value
            saberUltimoSaldo(miEmpresa.value)
        })
        productoServicio.addEventListener('change',() => {
            comprobarDatos()
        })
        cantidad.addEventListener('click',() => {
            comprobarDatos()
        })
        cantidad.addEventListener('change',() => {
            comprobarDatos()
        })
        
        comprobarDatos()
        function comprobarDatos() {
            if (empresa.value !== '' && (productoServicio.value !== '' && cantidad.value !== '')) {
                btnEnviar.classList.remove('activo')
                btnEnviar.disabled = false;
                // precio.value
                saldo.value = `${precio.value * cantidad.value}`
                debe.value = `${precio.value * cantidad.value}`
                spanSaldo.textContent = `${debe.value}`
            }else{
                btnEnviar.classList.add('activo')
                btnEnviar.disabled = true;
            }
        }
        
        let idTd = []
        // Saber ultimo saldo
        function saberUltimoSaldo(valor) {
            idTd = []

            idMax = 0

            tbody.forEach(tr => {
                const id = parseInt(tr.querySelector('td:nth-child(1)').textContent)
                const idMiEmpresa = parseInt(tr.querySelector('td:nth-child(2)').textContent)
                // const sacandoUltimoSaldo = parseInt(tr.querySelector('td:nth-child(8)').textContent)
    
                if (valor == idMiEmpresa) {
                    idTd.push(id)
                }
                
                // spanSaldo.textContent = `$ ${sacandoUltimoSaldo}`
                // sumarPrecio = sacandoUltimoSaldo
                // saldo.value = sacandoUltimoSaldo
            });

            const numeroMayor = Math.max(...idTd);
            idMax = numeroMayor
            continuar()
        }
    
        function continuar() {
            const itokens = JSON.parse('{!! json_encode($itokens) !!}')
            // console.log(idMax);

            itokens.forEach(token => {
                const id = token.id
                
                // console.log(id);
                if (id == idMax) {
                    console.log(token.saldo);
                    ultimoSaldo = token.saldo
                }
            })
        }

        // const titulo = document.querySelector('.titulo-form-agregar')
        btnEnviar.addEventListener('click', () => {
            const nuevoSaldo = `${precio.value * cantidad.value}`
            saldo.value = parseInt(nuevoSaldo) + parseInt(ultimoSaldo)
            console.log(saldo.value);
            // titulo.textContent = ''
        })

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
                    spanSaldo.textContent = ''
                    // spanHaber.textContent = ''
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

                    spanPrecio.textContent = precioProducto
                    spanDescripción.textContent = descripcionProducto
                    spanSaldo.textContent = precioProducto
                    // spanHaber.textContent = precioProducto
                    // spanHaber.style = ''
                    saldo.value = ''
                    cantidad.value = 1
                    comprobarDatos()
                }
            });
        })
    </script>
@endsection

