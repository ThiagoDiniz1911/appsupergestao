@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Adicionar produto ao pedido</p>
 

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('pedido.index')}}">Voltar</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">

    <h4 style="color: blue;">Detalhes do pedido</h4>
    <p style="color: blue;">Id do pedido: {{$pedido->id}}</p>
    <p style="color: blue;">Cliente: {{$pedido->cliente_id}}</p>
        <div style="width:30%; margin-left:auto; margin-right:auto;">
        <h4>Itens do pedido</h4>
        <table border="1" width="100%">
        <thead>
        <tr>
        <th>ID</th>
        <th>Nome do produto</th>
        <th>Data de inclusão</th>
        <th></th>
        <tr>
        </thead>
        <tbody>
        @foreach ($pedido->produtos as $produto)
            
        
        <tr>
        <td>{{$produto->id}}</td>
        <td>{{$produto->nome}}</td>
        <td>{{$produto->pivot->created_at->format('d/m/Y')}}</td>
        <td>
        <form id="form_{{$produto->pivot->id}}" method="post" action="{{route ('pedido-produto.destroy', ['pedidoProduto' => $produto->pivot->id, $pedido->id])}}">
        @method('DELETE')
        @csrf
        <a href=# onclick="document.getElementById('form_{{$produto->pivot->id}}').submit()">Excluir</a>
        </form>
        </td>
       
        </tr>
        @endforeach
        </tbody>
        </table>
        {{$pedido}}
        @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
        @endcomponent

        </div>
    </div>
</div>
@endsection