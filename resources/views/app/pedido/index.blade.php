@extends('app.layouts.basico')

@section('titulo', 'Cliente')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Listagem de Pedidos</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('pedido.create')}}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:90%; margin-left:auto; margin-right:auto;">
           <table border="1" width="100%">
            {{$pedidos->toJson()}}
                <thead>
                    <th>ID do pedido</th>
                    <th>Cliente</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>

           @foreach ($pedidos as $pedido)    
           <tr>
                <td>{{$pedido->id}}</td>
                <td>{{$pedido->cliente_id}}</td>
                <td><a href="{{route('pedido-produto.create', ['pedido'=>$pedido->id])}}">Adicionar Produtos</a></td>
                <td><a href="{{route('pedido.show', $pedido->id)}}">Exibir</a></td>
                <td>
                    <form method='post' id="form_{{$pedido->id}}" action='{{route('pedido.destroy', ['pedido' => $pedido->id])}}'>
                    @csrf
                    @method('DELETE')
                    <a href=# onclick="document.getElementById('form_{{$pedido->id}}').submit()">Excluir</a>
                    </form>
                </td>
                <td><a href="{{route('pedido.edit', $pedido->id)}}">Editar</a></td>
           </tr>
           @endforeach
                </tbody>
           </table>
           {{$pedidos->appends($request)->links()}}
           {{$pedidos->count()}} total de registros por página <br>
           {{$pedidos->total()}} total de registros <br>
           {{$pedidos->firstItem()}} primeiro item da pagina <br>
           {{$pedidos->lastItem()}} último item da página
        </div>

        {{$pedidos->toJson()}}
    </div>
</div>
@endsection