<?php

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $posts = [];
    //traer todos los posts
    //$posts = Post::all();
    
    //usando el user model //esto me da error pero siempre me sirve
    //$posts = auth()->user()->usersPosts()->latest()->get();

    //traer los posts solamente de la persona logeada
    if(auth()->check()){
        $posts = Post::where('user_id', auth()->id())->latest()->get();
    }
    //retornar nuestro blade pero tambien el arreglo con la data
    return view('home', ['posts' => $posts]);
});

Route::post('/register', [UserController::class, 'register']) ->name('user.register');
Route::post('/logout', [UserController::class, 'logout']) ->name('user.logout');
Route::post('/login', [UserController::class, 'login']) ->name('user.login');

//blog
Route::post('/create-post', [PostController::class, 'createPost']) ->name('post.create');
Route::get('/edit-post/{post:id}', [PostController::class, 'editPost']) ->name('post.edit');
Route::get('/edit-post/{post:id}', [PostController::class, 'editPost']) ->name('post.edit');
Route::put('/edit-post/{post:id}', [PostController::class, 'updatePost']) ->name('post.update');
Route::delete('/delete-post/{post:id}', [PostController::class, 'deletePost']) ->name('post.delete');
