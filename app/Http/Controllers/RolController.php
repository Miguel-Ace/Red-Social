<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RolController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('roles.roles',compact('users','roles'));
    }


    public function store(Request $request)
    {
        $user = User::find($request->user_id);
        $user->assignRole($request->role);


        return redirect()->back()->with('mensaje', 'Rol asignado correctamente.');
    }


    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles([$request->role]);


        return redirect()->back()->with('mensaje', 'Rol actualizado correctamente.');
    }


    public function destroy($id)
    {
        $user = User::find($id);
        $user->removeRole('admin');

        return redirect()->back()->with('mensaje', 'Rol eliminado correctamente.');
    }
}
