@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Produto - Editar</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('produto.index')}}">Voltar</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:30%; margin-left:auto; margin-right:auto;">
            @component('app.produto._components.form_create_edit',['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores])
           @endcomponent
        </div>
    </div>
</div>
@endsection