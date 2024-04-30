@extends('app.layouts.basico')

@section('titulo', 'Cliente')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Listagem de Clientes</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('cliente.create')}}">Novo</a></li>
            <li><a href="">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:90%; margin-left:auto; margin-right:auto;">
           <table border="1" width="100%">
            {{$clientes->toJson()}}
                <thead>
                    <th>Nome</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>

           @foreach ($clientes as $cliente)    
           <tr>
                <td>{{$cliente->nome}}</td>
                <td><a href="{{route('cliente.show', $cliente->id)}}">Exibir</a></td>
                <td>
                    <form method='post' id="form_{{$cliente->id}}" action='{{route('cliente.destroy', ['cliente' => $cliente->id])}}'>
                    @csrf
                    @method('DELETE')
                    <a href=# onclick="document.getElementById('form_{{$cliente->id}}').submit()">Excluir</a>
                    </form>
                </td>
                <td><a href="{{route('cliente.edit', $cliente->id)}}">Editar</a></td>
           </tr>
           @endforeach
                </tbody>
           </table>
           {{$clientes->appends($request)->links()}}
           {{$clientes->count()}} total de registros por página <br>
           {{$clientes->total()}} total de registros <br>
           {{$clientes->firstItem()}} primeiro item da pagina <br>
           {{$clientes->lastItem()}} último item da página
        </div>

        {{$clientes->toJson()}}
    </div>
</div>
@endsection