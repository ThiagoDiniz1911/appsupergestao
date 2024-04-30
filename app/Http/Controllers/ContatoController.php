<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato (Request $request){

        $motivo_contato = MotivoContato::all();

        /*print_r($request->all());
        print_r($request->input('nome'));
        print_r($request->input('telefone'));*/

        $contato = new SiteContato();
        /*$contato->nome = $request->input('nome');
        $contato->telefone = $request->input('telefone');
        $contato->email = $request->input('email');
        $contato->motivo_contato = $request->input('motivo_contato');
        $contato->mensagem = $request->input('mensagem');
        $contato->save();*/
        /*$contato->fill($request->all());
        $contato->save();*/
        //$contato->create($request->all());

       // print_r($contato->getAttributes());

        return view("site.contato", ['titulo' => 'contato teste', 'motivo_contato' => $motivo_contato] );
    }


    public function salvar(Request $request){

        $regras = [
            'nome' => 'required|min:3|max:40|unique:site_contatos',
            'telefone' => 'required',
            'email' => 'email',
            'motivo_contatos_id' => 'required',
            'mensagem' => 'required',
        ];
        $feedback = [
            'nome.required' => 'O campo nome deve ser preenchido',
            'nome.min'=> 'O campo nome tem que ter no mínimo 3 caracteres',
            'nome.max'=> 'O campo nome tem que ter no máximo 40 caracteres',
            'nome.unique'=> 'O campo nome tem que ser unico',
            'required' => 'O campo :attribute deve ser preenchido',
            'email.email' => 'O campo email deve ser valido'
        ];

        $request->validate($regras, $feedback);

        SiteContato::create($request->all());
        return redirect()->route('site.index');
    }
}
