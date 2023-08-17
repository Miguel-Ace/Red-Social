@extends('plantillas.plantilla')
@vite(['resources/js/tokens-innovacion.js'])

@section('ubicar-pagina')
    <p>Token de Innovación</p>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Selecciona - Token de innovación</div>
    <span class="cantidad-it"></span>
    <form action="{{url('/token-innovacion')}}" method="post" novalidate>
        @csrf
        <div class="contenedor-form">
            <div class="ocultar">
                <label for="fecha_hora">Fecha:</label>
                <input type="datetime-local" id="fecha_hora" name="fecha_hora" value="{{date('Y-m-d H:i:s')}}">
            </div>
            <div class="ocultar">
                <label for="id_mi_empresa">id_mi_empresa:</label>
                <input type="text" id="id_mi_empresa" name="id_mi_empresa" value="{{$user->id}}">
            </div>
            <div>
                <label for="id_empresa">Empresa:</label>
                <select name="id_empresa" id="id_empresa">
                    <option value="">Seleccione la empresa</option>
                    @foreach ($empresas as $empresa)
                        <option value="{{$empresa->id}}">{{$empresa->name}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="cantidad">Cantidad: <span id="valorSeleccionado">1</span></label>
                {{-- <input type="number" id="cantidad" name="cantidad"> --}}
                <input type="range" id="cantidad" name="cantidad" min="1" max="5" step="1" value="0">
            </div>
            {{-- <div>
                <label for="saldo">Saldo:</label>
                <input type="number" id="saldo" name="saldo" step="0.01">
            </div> --}}
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"></textarea>
            </div>
            {{-- <div>
                <label for="debe">Debe:</label>
                <input type="number" id="debe" name="debe" >
            </div> --}}

            {{-- <div>
                <label for="haber">Haber:</label>
                <input type="number" id="haber" name="haber" >
            </div> --}}
        </div>

        <button type="submit" class="btn-agregar">Agregar</button>
    </form>
@endsection

@section('tabla-empresa')
    <div class="titulo-tabla-empresa activo">TI Otorgado</div>
    <div class="titulo-tabla-empresa">TI Recibidos</div>

    <i class="fa-solid fa-arrows-rotate icon"></i>

    <table class="tabla1 mostrarTabla">
        <thead>
            <tr>
                {{-- <th>Número</th> --}}
                <th>Fecha</th>
                <th>Empresa</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                {{-- <th>Debe</th> --}}
                {{-- <th>Haber</th> --}}
                {{-- <th>Saldo</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($Tinnovacion as $token)
                @if ($token->id_mi_empresa == auth()->user()->id && $token->id_empresa != null)
                    <tr>
                        {{-- <td>1</td> --}}
                        <td>{{ \Carbon\Carbon::parse($token->fecha_hora)->diffForHumans() }}</td>
                        <td>{{$token->empresas->name}}</td>
                        <td>{{$token->cantidad}}</td>
                        <td>{{$token->descripcion}}</td>
                        {{-- <td>{{$token->debe}}</td> --}}
                        {{-- <td>{{$token->haber}}</td> --}}
                        {{-- <td>{{$token->saldo}}</td> --}}
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="tabla2">
        <thead>
            <tr>
                {{-- <th>Número</th> --}}
                <th>Fecha</th>
                <th>Empresa</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                {{-- <th>Debe</th> --}}
                {{-- <th>Haber</th> --}}
                {{-- <th>Saldo</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($Tinnovacion as $token)
                @if ($token->id_empresa == auth()->user()->id && $token->id_empresa != null)
                    <tr>
                        {{-- <td>1</td> --}}
                        <td>{{ \Carbon\Carbon::parse($token->fecha_hora)->diffForHumans() }}</td>
                        <td>{{$token->miEmpresas->name}}</td>
                        <td>{{$token->cantidad}}</td>
                        <td>{{$token->descripcion}}</td>
                        {{-- <td>{{$token->debe}}</td> --}}
                        {{-- <td>{{$token->haber}}</td> --}}
                        {{-- <td>{{$token->saldo}}</td> --}}
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <script>
        const campoEmpresa = document.querySelector('#id_empresa')
        const campoDescripcion = document.querySelector('#descripcion')
        const spanCantidad = document.querySelector('.cantidad-it')

        const btnAgregar = document.querySelector('.btn-agregar')
        const options = document.querySelectorAll('#id_empresa option')
        const user = JSON.parse('{!! $user->id !!}')

        const tInnovacion = JSON.parse('{!! json_encode($Tinnovacion) !!}')
        let arrSaldo = []
        let saldoTotal = 0

        tInnovacion.forEach(item => {
            if (item.id_empresa == user && item.cantidad != null) {
                arrSaldo.push(item.cantidad)
            }
        })

        for (let i = 0; i < arrSaldo.length; i++) {
            saldoTotal += parseInt(arrSaldo[i])
        }
        
        spanCantidad.textContent = saldoTotal
        // console.log(arrSaldo);


        // Comprobar datos vacios
        options.forEach(item => {
            if (user == item.value) {
                item.style = "display:none"
            }
        })

        comprobar()
        campoEmpresa.addEventListener('change', () => {comprobar()})
        campoDescripcion.addEventListener('change', () => {comprobar()})
        campoEmpresa.addEventListener('click', () => {comprobar()})
        campoDescripcion.addEventListener('keydown', () => {comprobar()})

        function comprobar() {
            // console.log(campoDescripcion.value.length);
            if (campoEmpresa.value == '' || campoDescripcion.value == '') {
                btnAgregar.disabled = true
                btnAgregar.classList.add('activo')
            }else{
                btnAgregar.disabled = false
                btnAgregar.classList.remove('activo')
            }
        }
    </script>

    <script>
        // =========== Barrita cantidad ===============
        const cantidad = document.getElementById("cantidad");
        const valorSeleccionado = document.getElementById("valorSeleccionado");

        cantidad.addEventListener('change', () => {
            valorSeleccionado.textContent = cantidad.value
            // console.log(cantidad.value);
        });
    </script>
@endsection