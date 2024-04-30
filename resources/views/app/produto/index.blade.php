@extends('app.layouts.basico')

@section('titulo', 'Produto')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Listagem de Produtos</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('produto.create')}}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:90%; margin-left:auto; margin-right:auto;">
           <table border="1" width="100%">
            {{$produtos->toJson()}}
                <thead>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Fornecedor</th>
                    <th>Fornecedor site</th>
                    <th>Peso</th>
                    <th>Unidade ID</th>
                    <th>Comprimento</th>
                    <th>Largura</th>
                    <th>Altura</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>

           @foreach ($produtos as $produto)    
           <tr>
                <td>{{$produto->nome}}</td>
                <td>{{$produto->descricao}}</td>
                <td>{{$produto->fornecedor->nome}}</td>
                <td>{{$produto->fornecedor->site}}</td>
                <td>{{$produto->peso}}</td>
                <td>{{$produto->unidade_id}}</td>
                <td>{{$produto->itemDetalhe->comprimento ?? ""}}</td>
                <td>{{$produto->itemDetalhe->largura ?? ""}}</td>
                <td>{{$produto->itemDetalhe->altura ?? ""}}</td>
                <td><a href="{{route('produto.show', $produto->id)}}">Exibir</a></td>
                <td>
                    <form method='post' id="form_{{$produto->id}}" action='{{route('produto.destroy', ['produto' => $produto->id])}}'>
                    @csrf
                    @method('DELETE')
                    <a href=# onclick="document.getElementById('form_{{$produto->id}}').submit()">Excluir</a>
                    </form>
                </td>
                <td><a href="{{route('produto.edit', $produto->id)}}">Editar</a></td>
           </tr>
           <tr>
           <td colspan="12">
           @foreach ($produto->pedidos as $pedido)
              <a href="{{route('pedido-produto.create', ['pedido' => $pedido->id])}}">
              Pedido {{$pedido->id}}</a>
           @endforeach
           </td>
           </tr>
           @endforeach
                </tbody>
           </table>
           {{$produtos->appends($request)->links()}}
           {{$produtos->count()}} total de registros por página <br>
           {{$produtos->total()}} total de registros <br>
           {{$produtos->firstItem()}} primeiro item da pagina <br>
           {{$produtos->lastItem()}} último item da página
        </div>

        {{$produtos->toJson()}}
    </div>
</div>
@endsection