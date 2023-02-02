<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ImagenController;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\Auth\RegisterController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

//Auth
Route::get('/register', [RegisterController::class, 'index'])->name('register'); // con ->name(nombreX) definimos una ruta para al momento de cambiarla sea mas facil hacerlo
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

//Routes para Perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');


//Formulario de creación
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//Envio de datos al servidor
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//Vista de la publicación
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//Eliminar un Post
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//Enviar comentario al servidor
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

//Subida de Imagen 
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//Like a las fotos
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

//Quitar el like
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//Rout Model Binding
Route::get('/{user:username}', [PostController::class, 'index'])->name("posts.index");

//Siguiendo a Usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');
