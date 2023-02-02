<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // public $mensaje = "Hola Mundo desde un atributo";
    public $post;
    public $likes;
    public $isLiked;

    //Solo evalua el componente
    public function mount($post)
    {
        $this->likes = $post->likes->count();
        $this->isLiked = $post->checkLike(auth()->user());
    }

    public function like()
    {
        //Si ya dio like lo va a eliminar
        if ($this->post->checkLike(auth()->user())) {
            //Eliminar los likes del id del usuario donde en la tabla de likes el valor de la columna post_id sea 
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
