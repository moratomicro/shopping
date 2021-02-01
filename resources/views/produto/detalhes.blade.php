@extends('layouts.principal')

@section('conteudo')
    <h1><u>{{ $title }} {{ $resposta->nome }}</u></h1>
        <p><b>ID:</b>        {{ $resposta->id }}</p>
        <p><b>VALOR:</b> R$  {{ $resposta->valor }}</p>
        <p><b>DESCRIÇÃO:</b> {{ $resposta->descricao }}</p>
        <p><b>QTD:</b>       {{ $resposta->quantidade }}</p>
        <p>
            @if ($resposta->imagem)
                <img src="{{ url("storage/{$resposta->imagem}") }}" alt="{{ $resposta->nome }}" style="max-width: 300px;">
            @endif
        </p>
        {!! Form::open(['route' => ['produtos.destroy', $resposta->id], 'method' => 'DELETE']) !!}
            {!! Form::submit("Deletar: $resposta->nome", ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
        <br />
        <a href="{{ route('produtos.index') }}">
        <button type="button" class="btn btn-outline-success">Cancelar</button>
        </a>
@endsection
