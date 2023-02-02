<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //En caso de que el usuario no se pueda autenticar
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            //Retorna un mensaje en una session
            //back permite volver a la página anterior
            return back()->with('mensaje', 'Credenciales Incorrectas');
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
