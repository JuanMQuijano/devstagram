<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class CommentPost extends Component
{

    public $post;
    public $comentario;
    public $comentarios;

    public function mount($post)
    {        
        $this->comentarios = $post->comentarios;
    }

    public function comment()
    {
        // Validar
        $this->validate([
            'comentario' => 'required|max:255'
        ]);
        
        // Almacenar
        $newComment = Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario
        ]);

        $this->comentarios->push($newComment);
        $this->reset('comentario');
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
