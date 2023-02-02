<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store(Request $request)
    {
        //Utilizamos la función file, para obtener el archivo
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . "." . $imagen->extension(); //Generamos un id unico para la imagen

        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000,1000); 

        $imagenPath = public_path('uploads') . '/' . $nombreImagen; //Creamos la ruta
        $imagenServidor->save($imagenPath);

        //Retornamos una respuesta al servidor en formato json
        return response()->json(['imagen' => $nombreImagen]);
    }
}
