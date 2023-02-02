@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            @if (session('mensaje'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">
                    {{ session('mensaje') }}
                </p>
            @endif

            <form method="POST" action="{{ route('perfil.store') }}" class="mt-10 md:mt-0" enctype="multipart/form-data">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario"
                        class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror"
                        value="{{ auth()->user()->username }}">

                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil</label>
                    <input type="file" name="imagen" id="imagen" accept=".jpg, .png, .jpeg"
                        class="border p-3 w-full rounded-lg" value="">
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Tu Email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror"
                        value="{{ auth()->user()->email }}">

                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="oldpassword" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña</label>
                    <input type="password" name="oldpassword" id="oldpassword" placeholder="Tu Contraseña Actual"
                        class="border p-3 w-full rounded-lg @error('oldpassword') border-red-500 @enderror">

                    @error('oldpassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Tu Nueva Contraseña"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">

                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar
                        Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirma Tu Nueva Contraseña"
                        class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror">

                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center uppercase">{{ $message }}
                        </p>
                    @enderror
                </div>

                <input type="submit" value="Guardar Cambios"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection
