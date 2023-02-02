<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        //Modificar el Request
        $request->request->add(['username' => Str::slug($request->username)]); //Convierte el username a una URl

        //Validación
        $this->validate($request, [
            'name' => 'required|min:5',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' => 'required|confirmed|min:6'
            //Con el confirmed nos aseguramos de que el campo password_confirmation que tenemos en el front coincida
        ]);

        //Importamos el modelo de user
        User::create([
            'name' => $request->name,
            'username' => $request->username, //Convierte el username a una URl
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Autenticar un usuario
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        //Otra forma de autenticar
        auth()->attempt($request->only('email','password'));

        //Redireccionar al usuario hacia la ruta
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
