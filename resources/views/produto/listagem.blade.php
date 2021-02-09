@extends('layouts.principal')

@section('conteudo')
    @if(empty($produtos))

    <div class="alert alert-danger">
        Sem Produtos Cadastrados.
    </div>

    @else

    <h1>{{ $title ?? 'Gerenciamento de Produtos' }}</h1>
    <table class="table table-bordered table-hover table-responsive">
        <tr>
            <th>NOME:</th>
            <th width="7%">VALOR:</th>
            <th>QTD:</th>
            <th>IMAGEM:</th>
            <th width="10%">AÇÃO</th>
        </tr>
        @foreach ($produtos as $p)
        <tr class="{{$p->quantidade<=1 ? 'alert alert-danger' : ''}}">
            <td>{{ $p->nome }}</td>
            <td>R$ {{ $p->valor }}</td>
            <td>{{ $p->quantidade }}</td>
            <td>
                @if ($p->imagem)
                    <img src="{{ url("storage/{$p->imagem}") }}" alt="{{ $p->nome }}" style="width: 250px; height: 250px;">
                @endif
            </td>
            <td align="center">
                <a href="{{ route('produtos.show', $p->id) }}">
                    <button type="button" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                        </svg>
                    </button>
                </a>
                <a href="{{ route('produtos.edit', $p->id) }}">
                    <button type="button" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                        </svg>
                    </button>
                </a>
                <form method="POST" action="{{ route('produtos.destroy', $p->id) }}" style="display: inline" onsubmit="return confirm('TEM CERTEZA QUE DESEJA EXCLUIR ESTE REGISTRO?');" >
                    @csrf
                    <input type="hidden" name="_method" value="delete" >
                    <button class="btn btn-danger btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                        </svg>
                    </button>
                </form>                
            </td>
        </tr>
        @endforeach
    </table>    
    @endif

    <h4>
        <span class="label label-danger pull-right">
            Um ou menos itens no estoque.
        </span>
    </h4>

    {{ $produtos->links() }}
    <br />
    <br />

@endsection