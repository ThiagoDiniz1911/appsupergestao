<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Fornecedor;

class FornecedorController extends Controller
{
    
    public function index(){
        return view('app.fornecedor.index');
    }

    public function listar(Request $request){

        $fornecedor = Fornecedor::with(['produtos'])->where('nome', 'like', '%'.$request->input('nome').'%')
        ->where('site', 'like', '%'.$request->input('site').'%')
        ->where('uf', 'like', '%'.$request->input('uf').'%')
        ->where('email', 'like', '%'.$request->input('email').'%')->paginate(5);

    
        return view('app.fornecedor.listar', ['fornecedor' => $fornecedor, 'request' => $request->all()]);
    }
    
    public function adicionar(Request $request){

        $msg = "";

        if($request->input('_token') != '' && $request->input('id') == ''){
            
            $regras = [
                'nome' => 'required|min:3|max:40',
                'site' => 'required',
                'uf' => 'required|min:2|max:2',
                'email'=> 'email'];

            $feedback = [
                
                'required' => 'O campo :attribute deve ser preenchido',
                'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
                'nome.max' => 'O campo nome deve ter no maximo 40 caracteres',
                'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
                'uf.max' => 'O campo uf deve ter no maximo 2 caracteres',
                'email' => 'O email tem que ser válido'
            ];

            $request->validate($regras, $feedback);

            Fornecedor::create($request->all());

            $msg = "Cadastro realizado com sucesso";
        }
        
        
        if($request->input('_token') != '' && $request->input('id') != ''){
            $fornecedor = Fornecedor::find($request->input('id'));
            $update = $fornecedor->update($request->all());

            if($update){
                $msg  = "Update realizado com sucesso";
            } else {
                $msg = "Update deu problema";
            }
            return redirect()->route('app.fornecedor.editar',  ['id' =>$request->input('id'), 'msg' => $msg]);
        }
        
        ;
        return view('app.fornecedor.adicionar', ['msg' => $msg]);
    }

    public function editar($id, $msg = ''){

        $fornecedor = Fornecedor::find($id);
        return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' =>$msg]);
    }

    public function remover($id){
        $fornecedor = Fornecedor::find($id);
        $fornecedor->delete();
        return redirect()->route('app.fornecedor');
    }
}