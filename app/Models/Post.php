<?php

namespace App\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user()
    {
        //Un POST pertenece a un usuario
        return $this->belongsTo(User::class)->select(['name', 'username']);
        //Podemos especificar qué información queremos traer de la BD
    }

    public function comentarios()
    {
        //Un post tiene multiples comentarios
        return $this->hasMany(Comentario::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function checkLike(User $user)
    {
        //Se posiciona en la tabla de likes y revisa si la columna user_id tiene el valor
        //Que le estamos pasando
        return $this->likes->contains('user_id', $user->id);
    }
}
