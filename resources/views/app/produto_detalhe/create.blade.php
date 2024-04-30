@extends('app.layouts.basico')

@section('titulo', 'Detalhes do Produto')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Produto Detalhe Adicionar</p>
 

    </div>
    <div class="menu">
        <ul>
            <li><a href="">Voltar</a></li>
        
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:30%; margin-left:auto; margin-right:auto;">
           @component('app.produto_detalhe._components.form_create_edit',  ['unidades' => $unidades])
           @endcomponent

        </div>
    </div>
</div>
@endsection