@extends('layouts.principal')

@section('conteudo')
<div class="container span7 text-left col-md-40 col-md-offset-0">
<h3 class="title-pg">Gestão do produto: <br> <b>{{$produto->nome ?? 'Novo'}}</b></h3>
    @if( isset($errors) && count($errors) > 0)
	<div class="alert alert-danger">
            @foreach( $errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach
    	</div>
    @endif

    <hr>
    @if( isset($produto))
        {!! Form::model($produto, ['route' => ['produtos.update', $produto->id], 'class' => 'form', 'method' => 'put', 'enctype' => 'multipart/form-data' ]) !!}    
    @else    
        {!! Form::open(['route' => 'produtos.store', 'class' => 'form', 'enctype' => 'multipart/form-data'] ) !!}    
    @endif
        <div style="background-color:lightblue; width: 950px; text-align: left">
            <div class="form-group" style="width: 900px">    		
                {!! Form::label('nome', 'Nome:', ['class' => 'control-label']) !!}     		
                {!! Form::text('nome', null, ['placeholder' => 'Nome:', 'class' => 'form-control', 'autofocus'=>'autofocus']) !!}
            </div>

            <div class="form-group" style="width: 900px">           
                {!! Form::label('descricao', 'Descrição:', ['class' => 'control-label']) !!}          
                {!! Form::textarea('descricao', null, ['placeholder' => 'Descrição:', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="width: 150px">
                {!! Form::label('valor', 'Valor: R$', ['class' => 'control-label']) !!}                
                {!! Form::text('valor', null, ['placeholder' => 'Valor:', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="width: 50px">
                {!! Form::label('quantidade', 'Qtd:', ['class' => 'control-label']) !!}                
                {!! Form::text('quantidade', null, ['placeholder' => 'Qtd:', 'class' => 'form-control']) !!}
            </div>

            <div class="form-group" style="width: 150px">
                {!! Form::label('imagem', 'Imagem:', ['class' => 'control-label']) !!}                
                {!! Form::file('imagem', null, ['placeholder' => 'Imagem:', 'class' => 'form-control']) !!}
            </div>

            {!! Form::submit('Salvar', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
        
@endsection