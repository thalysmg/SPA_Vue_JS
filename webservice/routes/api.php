<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
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

Route::post('/cadastro', function (Request $request) {
    $data = $request->all();
    $validacao = Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'endereco' => 'required|string|max:255',
        'cidade' => 'required|string|max:100',
        'estado' => 'required|string|max:100',
        'pais' => 'required|string|max:100',
        'telefone' => 'required|string|max:12',
    ]);

    if ($validacao->fails()) {
        return $validacao->errors();
    }

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'endereco' => $data['endereco'],
        'cidade' => $data['cidade'],
        'estado' => $data['estado'],
        'pais' => $data['pais'],
        'telefone' => $data['telefone']
    ]);
    $user->token = $user->createToken($user->email)->accessToken;

    return $user;
});

Route::post('/login', function (Request $request) {
    $data = $request->all();

    $validacao = Validator::make($data, [
        'email' => 'required|string|email|max:255',
        'password' => 'required|string',
    ]);

    if ($validacao->fails()) {
        return $validacao->errors();
    }

    if (Auth::attempt(['email'=> $data['email'], 'password'=> $data['password']])) {
        $user = auth()->user();
        $user->token = $user->createToken($user->email)->accessToken;
        return $user;
    } else {
        return ['status' => false];
    }
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

