<?php

use App\User;
use App\Conteudo;
use App\Comentario;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/cadastro', 'UsuarioController@cadastrar');
Route::post('/login', 'UsuarioController@login');
Route::middleware('auth:api')->put('/perfil', 'UsuarioController@atualizarPerfil');
Route::middleware('auth:api')->post('/usuario/amigo', 'UsuarioController@amigo');
Route::middleware('auth:api')->get('/usuario/listaamigos', 'UsuarioController@listaamigos');
Route::middleware('auth:api')->get('/usuario/listaamigospagina/{id}', 'UsuarioController@listaamigospagina');


Route::middleware('auth:api')->post('/conteudo/adicionar', 'ConteudoController@adicionar');
Route::middleware('auth:api')->get('/conteudo/listar', 'ConteudoController@listar');
Route::middleware('auth:api')->put('/conteudo/curtir/{id}', 'ConteudoController@curtir');
Route::middleware('auth:api')->put('/conteudo/curtirpagina/{id}', 'ConteudoController@curtirpagina');
Route::middleware('auth:api')->put('/conteudo/comentar/{id}', 'ConteudoController@comentar');
Route::middleware('auth:api')->put('/conteudo/comentarpagina/{id}', 'ConteudoController@comentarpagina');
Route::middleware('auth:api')->get('/conteudo/pagina/listar/{id}', 'ConteudoController@pagina');

Route::get('/testes', function() {

    // $user = $request->user();
    $user = User::find(20);
    $amigos = $user->amigos()->pluck('id');
    $amigos->push($user->id);
    $conteudos = Conteudo::whereIn('user_id', $amigos)->with('user')->orderBy('data', 'DESC')->paginate(5);

    dd($conteudos);

    // $user = User::find(20);
    // // dd(Conteudo::all());
    // $conteudo = Conteudo::find(19);
    // $user->comentarios()->create([
    //     'conteudo_id' => $conteudo->id, 
    //     'texto' => "Meu primeiro comentário do meu primeiro conteúdo", 
    //     'data'=> date('Y-m-d H:i:s')
    // ]);
    // $user9 = User::find(9);

    //deleta todas as instâncias de uma entidade
    /*
    $conteudos = Conteudo::all();
    $users = User::all();
    
    foreach ($users as $key => $value) {
        $value->delete();
    }
    */


    /* 
    $user->conteudos()->create([
        'titulo' => 'Conteúdo 2',
        'texto' => "Meu segundo conteúdo na vida",
        'imagem' => 'url da imagem',
        'link' => 'Link',
        'data' => '2019-05-02'
    ]);
    return $user->conteudos;
    */
    
    /*
    $user->amigos()->attach($user9->id);
    $user->amigos()->detach($user9->id);
    
    $user->amigos()->toggle($user9->id);

    return $user->amigos;
    */

    /*
    $conteudo = Conteudo::find(1);
    $user->curtidas()->toggle($conteudo->id);

    return $conteudo->curtidas()->count(); 
    */


    /*
    $conteudo = Conteudo::find(1);
    $user->comentarios()->create([
        'conteudo_id' => $conteudo->id, 
        'texto' => "Meu primeiro comentário do meu primeiro conteúdo", 
        'data'=> date('Y-m-d')
    ]);
    $user9->comentarios()->create([
        'conteudo_id' => $conteudo->id, 
        'texto' => "Meu segundo comentário do meu conteúdo", 
        'data'=> date('Y-m-d')
    ]);
    return $conteudo->comentarios;
    */
});
