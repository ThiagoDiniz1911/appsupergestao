<?php

namespace App\Http\Controllers;

use App\Unidade;
use App\Produto;
use App\Fornecedor;
use App\Item;
use App\ProdutoDetalhe;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        $produtos = Item::with(['itemDetalhe', 'fornecedor'])->paginate(10);

        /*foreach($produtos as $key => $produto){

            //print_r($produto->getAttributes());

            //echo "<br><br><br>";

            $produto_detalhe = ProdutoDetalhe::where('produto_id', $produto->id)->first();

            if(isset($produto_detalhe)){
                //print_r($produto_detalhe->getAttributes());
                //echo "<br><br><br>";
          

            $produtos[$key]['comprimento'] = $produto_detalhe->comprimento;
            $produtos[$key]['largura'] = $produto_detalhe->largura;
            $produtos[$key]['altura'] = $produto_detalhe->altura;
            }
        }*/
        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.create', ['unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:2000',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];

        $feedback = [ 
            'required' => 'O campo :attribute precisa ser preenchido',
            'nome.min' => 'O campo nome tem que ter no mínimo 3 carasteres',
            'nome.max' => 'O campo nome tem que ter no maximo 40 carasteres',
            'descricao.min' => 'O campo descricao tem que ter no mínimo 3 carasteres',
            'descricao.max' => 'O campo descricao tem que ter no maximo 2000 carasteres',
            'peso.integer' => 'O peso precisa ser um valor inteiro',
            'unidade_id.exists' => 'A unidade de medida informada não existe',
            'fornecedor_id.exists' =>'Precisa selecionar um fornecedor' 
        ];

        $request->validate($regras,$feedback);


     
        $produto = new Item();
        $produto->nome = $request->get('nome');
        $produto->descricao = $request->get('descricao');
        $produto->peso = $request->get('peso');
        $produto->unidade_id = $request->get('unidade_id');
        $produto->fornecedor_id = $request->get('fornecedor_id');
        $produto->save();
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        //
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
        //return view('app.produto.create', ['produto' => $produto, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $produto)
    {
       // print_r($produto->id);
        //echo $produto;
       // print_r($request->all());
       $regras = [
        'nome' => 'required|min:3|max:40',
        'descricao' => 'required|min:3|max:2000',
        'peso' => 'required|integer',
        'unidade_id' => 'exists:unidades,id',
        'fornecedor_id' => 'exists:fornecedores,id'
    ];

    $feedback = [ 
        'required' => 'O campo :attribute precisa ser preenchido',
        'nome.min' => 'O campo nome tem que ter no mínimo 3 carasteres',
        'nome.max' => 'O campo nome tem que ter no maximo 40 carasteres',
        'descricao.min' => 'O campo descricao tem que ter no mínimo 3 carasteres',
        'descricao.max' => 'O campo descricao tem que ter no maximo 2000 carasteres',
        'peso.integer' => 'O peso precisa ser um valor inteiro',
        'unidade_id.exists' => 'A unidade de medida informada não existe',
        'fornecedor_id.exists' =>'Precisa selecionar um fornecedor'
    ];

    $request->validate($regras,$feedback);

        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        
        return redirect()->route('produto.index');
    }
}
