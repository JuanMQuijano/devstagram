<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    //

    public function store(Request $request, Post $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id
        ]);

        return back();
    }

    public function destroy(Request $request, Post $post)
    {
        //Eliminar los likes del id del usuario donde en la tabla de likes el valor de la columna post_id sea 
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
