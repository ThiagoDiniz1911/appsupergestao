@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Fornecedor - Listar</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></li>
            <li><a href="{{route('app.fornecedor')}}">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:90%; margin-left:auto; margin-right:auto;">
           <table border="1" width="100%">
                <thead>
                    <th>Nome</th>
                    <th>Site</th>
                    <th>UF</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>

           @foreach ($fornecedor as $f)    
           <tr>
                <td>{{$f->nome}}</td>
                <td>{{$f->site}}</td>
                <td>{{$f->uf}}</td>
                <td>{{$f->email}}</td>
                <td><a href="{{route('app.fornecedor.remover', $f->id)}}">Excluir</a></td>
                <td><a href="{{route('app.fornecedor.editar', $f->id)}}">Editar</a></td>
           </tr>
           <tr>
                <td colspan="6">
                    <p>Lista de produtos</p>
                    <table border="1" style="margin:20px">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{$f->toJson()}}
                            @foreach($f->produtos as $key => $produto)
                                <tr>
                                    <td>{{$produto->id}}</td>
                                    <td>{{$produto->nome}}</td>
                                <tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
           </tr>
           @endforeach
                </tbody>
           </table>
           {{$fornecedor->appends($request)->links()}}
           {{$fornecedor->count()}} total de registros por página <br>
           {{$fornecedor->total()}} total de registros <br>
           {{$fornecedor->firstItem()}} primeiro item da pagina <br>
           {{$fornecedor->lastItem()}} último item da página
        </div>
    </div>
</div>
@endsection