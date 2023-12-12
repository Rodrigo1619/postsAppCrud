<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function createPost(Request $request){
        $data = $request->validate([
            'tittle' => 'required',
            'body' => 'required'
        ]);
        //almacenar como texto plano y no dejar que se guarden como html/php etc.
        $data['tittle'] = strip_tags($data['tittle']); 
        $data['body'] = strip_tags($data['body']);
        
        //haciendo match con el id del usuario que hizo el post
        $data['user_id'] = auth()->id();

        //guardando el post
        Post::create($data);

        return redirect('/');
    }
    public function editPost(Post $post){
        //protegiendo que niongun usuario pueda editar el post de otro
        if(auth()->user()->id != $post['user_id']){
            return redirect('/');
        }
        return view('edit-post',['post' => $post]);
    }
    public function updatePost(Post $post, Request $request){
        //post nos da lo que queremos actualiza y request lo que sea que el usuario este mandando

        if(auth()->user()->id != $post['user_id']){
            return redirect('/');
        }
        $data = $request->validate([
            'tittle' => 'required',
            'body' => 'required'
        ]);
        //almacenar como texto plano y no dejar que se guarden como html/php etc.
        $data['tittle'] = strip_tags($data['tittle']); 
        $data['body'] = strip_tags($data['body']);

        $post ->update($data);
        return redirect('/');
    }
    public function deletePost(Post $post){
        if(auth()->user()->id === $post['user_id']){
            $post->delete();
        }
        return redirect('/');
    }

}
