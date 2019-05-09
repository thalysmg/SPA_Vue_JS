<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conteudo;
use Illuminate\Support\Facades\Validator;

class ConteudoController extends Controller
{
    public function listar(Request $request) 
    {
        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        return ['status'=>true, "conteudos"=>$conteudos];
    }

    public function adicionar(Request $request) 
    {
        $data = $request->all();
        $user = $request->user();

        $validacao = Validator::make($data, [
            'titulo' => 'required',
            'texto' => 'required',
        ]);
    
        if ($validacao->fails()) {
            return ['status'=>false, "validacao"=>true, "erros"=>$validacao->errors()];
        }

        $conteudo = new Conteudo;

        $conteudo->titulo = $data['titulo'];
        $conteudo->texto = $data['texto'];
        $conteudo->link = $data['link'] ? $data['link'] : '#';
        $conteudo->imagem = $data['imagem'] ? $data['imagem'] : '#';
        $conteudo->data = date('Y-m-d H:i:s');
        
        $user->conteudos()->save($conteudo);

        $conteudos = Conteudo::with('user')->orderBy('data', 'DESC')->paginate(5);
        return ['status'=>true, "conteudos"=>$conteudos];

        // $user->conteudos()->create([
        //     'titulo' => 'Conteúdo 2',
        //     'texto' => "Meu segundo conteúdo na vida",
        //     'imagem' => 'url da imagem',
        //     'link' => 'Link',
        //     'data' => '2019-05-02'
        // ]);
        // return $user->conteudos;
    }
}
