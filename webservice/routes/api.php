<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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

Route::middleware('auth:api')->get('/usuario', 'UsuarioController@getUsuario');

Route::post('/cadastro', 'UsuarioController@cadastrar');

Route::post('/login', 'UsuarioController@login');

Route::middleware('auth:api')->put('/perfil', 'UsuarioController@atualizarPerfil');