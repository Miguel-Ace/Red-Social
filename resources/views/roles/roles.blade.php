@extends('plantillas.plantilla')

@section('ubicar-pagina')
    <p>Roles</p>    
@endsection

@section('catalogo')
    <a href="/">Itoken</a>
    <a href="{{url('/token-innovacion')}}">Token de innovacion</a>
@endsection

@section('agregar')
    <div class="titulo-form-agregar">Agregar - Rol</div>

    <form action="/assign" method="post">
        @csrf
        <div class="contenedor-form">
            <div class="form-group">
                <label for="user_id">Usuario</label>
                <select name="user_id" id="user_id" class="form-control">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="role">Rol</label>
                <select name="role" id="role" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn-enviar">Asignar rol</button>
    </form>
@endsection

@section('tabla-empresa')
    <div class="titulo-tabla-empresa activo">
        Detalle
    </div>

    <table class="mostrarTabla">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                    <td class="modificadores-icon">
                        {{-- <form action="{{ route('role.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <select name="role" id="role" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar</button>
                        </form> --}}

                        <form action="{{ url('assign/'.$user->id) }}" method="post" class="btn-borrar">
                            @csrf
                            @method('DELETE')
                            <button><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
