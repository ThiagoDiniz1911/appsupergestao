@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')



@section('conteudo')

<div class="conteudo-pagina">
    <div class="titulo-pagina">

        <p>Fornecedor - Adicionar</p>

    </div>
    <div class="menu">
        <ul>
            <li><a href="{{route('app.fornecedor.adicionar')}}">Novo</a></li>
            <li><a href="{{route('app.fornecedor')}}">Consulta</a></li>
        </ul>
    </div>

    <div class="informação-pagina">
        <div style="width:30%; margin-left:auto; margin-right:auto;">
            {{$msg ?? ""}}
            <form method="post" action="{{route('app.fornecedor.adicionar')}}">
                @csrf
                <input type="hidden" name="id" value="{{$fornecedor->id ?? ""}}">
                <input type="text" name= "nome" value="{{$fornecedor->nome ?? old('nome')}}" placeholder = "nome" class="borda-preta">
                {{$errors->has('nome') ? $errors->first('nome') : ""}}
                <input type="text" name= "site" value="{{$fornecedor->site ?? old('site')}}" placeholder = "site" class="borda-preta">
                {{$errors->has('site') ? $errors->first('site') : ""}}
                <input type="text" name= "uf" value="{{$fornecedor->uf ?? old('uf')}}" placeholder = "UF" class="borda-preta">
                {{$errors->has('uf') ? $errors->first('uf') : ""}}
                <input type="text" name= "email" value="{{$fornecedor->email ?? old('email')}}" placeholder = "email" class="borda-preta">
                {{$errors->has('email') ? $errors->first('email') : ""}}
                <button type="submit" class="borda-preta">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection