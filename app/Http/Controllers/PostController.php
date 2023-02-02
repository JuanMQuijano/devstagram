<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //Protegemos la vista o la ruta de esta manera
    public function __construct()
    {
        //Revisa que el usuario esté autenticado
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(User $user)
    {
        // $posts = Post::where('user_id', $user->id)->simplePaginate(4);
        $posts = $user->posts()->latest()->simplePaginate(4);

        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //Permite visualizar el formulario
    public function create()
    {
        return view('post.create');
    }

    //Permite enviar la información al servidor
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //Otra forma de almacenar información 
        // $request->user()->posts()->create([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('post.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        //Eliminar la imagen
        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);            
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
