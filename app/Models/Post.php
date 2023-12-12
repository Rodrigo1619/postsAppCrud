<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable =[
        'tittle',
        'body',
        'user_id'
    ];

    //viendo la relacion entre un post y un usuario para mostrarlo en el post
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
