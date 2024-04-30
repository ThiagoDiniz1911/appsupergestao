<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class LoginController extends Controller
{
    public function index(Request $request){
        
        $erro = $request->get('erro');
        if($request->get('erro') == 1){
            $erro = "Usuário e ou senha não existe";
        }

        if($request->get('erro') == 2){
            $erro = "Necessário realizar login para ter acesso a página";
        }
        return view('site.login', ['titulo' => 'login', 'erro' => $erro ]);
    }

    public function autenticar(Request $request){
        
        $regras = [
            'usuario' => 'email',
            'senha' => 'required'
        ];

        $feedback = [
            'usuario.email' => 'O email não está correto',
            'senha.required' => 'A senha é obrigatória'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $senha = $request->get('senha');

        //echo "O e mail é ". $email. " e a senha é " .$senha;

        $user = new User();

        $usuario = $user->where('email', $email)->where('password', $senha)->get()->first();

        if(isset($usuario->email)){
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            return redirect()->route('app.home');
        } else {
            return redirect()->route('site.login', ['erro' => 1]);
        }

        print_r($request->all());

    }

    public function sair(){
        session_destroy();
        return redirect()->route('site.index');
        echo "Sair";
    }
}