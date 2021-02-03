@extends('layouts.principal')
@section('conteudo')
@extends('layouts.app')
<div class="content">
    <h1>{{ $title ?? 'Home Page' }}</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
            <th scope="col">Nome</th>
            <th scope="col">Imagem</th>
            <th scope="col">Valor</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            @foreach ($produtos as $p)
            <td>{{ $p->nome }}</td>
            <td>
                @if ($p->imagem)
                    <img src="{{ url("storage/{$p->imagem}") }}" alt="{{ $p->nome }}" style="max-width: 50px;">
                @endif
            </td>
            <td>{{ $p->valor }}</td>
            </tr>            
        </tbody>
        @endforeach
    </table>
    {{ $produtos->links() }}
    <br />
    <br />
@endsection