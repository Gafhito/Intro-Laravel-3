<?php

use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\User;

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

Route::get('eloquent', function () {
    $posts = Post::where('id', '>=', '20')  // Permite obtener los registros del id del 20 al 30
        ->orderBy('id', 'desc')  // Permite ordenar de forma descendente
        ->take(3)  // Obtiene un límite de 3 elementos
        ->get();  // Obtiene los elementos al final

    foreach ($posts as $post) {
        echo "$post->id $post->title <br>";
    }
});

Route::get('posts', function () {
    $posts = Post::get();

    foreach ($posts as $post) {
        echo "
        $post->id
        <strong>{$post->user->name}</strong>
        $post->title
        <br>";
    }
});

Route::get('posts', function () {
    $posts = Post::get();

    foreach ($posts as $post) {
        echo "
        $post->id
        <strong>{$post->user->get_name}</strong>
        $post->get_title
        <br>";
    }
});

Route::get('users', function () {
    $users = User::get();

    foreach ($users as $user) {
        echo "
        $user->id
        <strong>$user->get_name</strong>
        {$user->posts->count()} posts
        <br>";
    }
});

Route::get('collections', function () {
    $users = User::all();

    //dd($users);
    //dd($users->contains(4));
    //dd($users->contains(5));
    //dd($users->except([1,2,3]));
    //dd($users->only(4));
    //dd($users->find(4));
    dd($users->load('posts'));
});

Route::get('serialization', function () {
    $users = User::all();

    //dd($users->toArray());
    $user = $users->find(1);
    //dd($user);
    dd($user->toJson());
});
