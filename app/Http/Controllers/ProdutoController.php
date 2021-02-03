<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    private $produtos;
    private $totalPage = 10;

    public function __construct(Produto $produtos)
    {
        $this->produtos = $produtos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Gerenciamento';
        $produtos = $this->produtos->paginate($this->totalPage);
        
        if(Auth::check() === true) {
            return view('produto.listagem', compact('produtos', 'title'));
        }
        return redirect()->route('admin.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Produto';

        if(Auth::check() === true) {
            return view('produto.formulario', compact('title'));
        }
        return redirect()->route('admin.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $title = 'Cadastrar Novo Produto';        
        $data = $request->except('_token');
        $data['active'] = (!isset($data['active'])) ? 0 : 1;
        
        if ($request->hasFile('imagem') && $request->imagem->isValid()) {
            $fotoPath = $request->imagem->store('produtos/img');
            $data['imagem'] = $fotoPath;
        }

        $insert = $this->produtos->create($data);
        
        if ($insert)
            return redirect()->route('produtos.index')->with('success', 'Registro inserido com sucessso!');
        else
            return redirect()->route('produtos.create')->with('error', 'Falha ao tentar inserir o registro.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {           
        $resposta = $this->produtos->find($id);
        $title = "Detalhe do Produto";

        if(Auth::check() === true) {
            if(empty($resposta)){
                return "Erro!! Cadastro não encontrado.";
            }
            return view('produto.detalhes', compact('resposta', 'title'));
        }
        return redirect()->route('admin.login');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->produtos->find($id);
        $title = "Editar Produto: {$produto->nome}";

        if(Auth::check() === true) {
        return view('produto.formulario', compact('produto', 'title'));
        }
        return redirect()->route('admin.login');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {                
        //Recupera todos os dados do formulário
        $dataForm = $request->all();
        
        //Recupera o item para editar
        $produto = $this->produtos->find($id);

        if ($request->hasFile('imagem') && $request->imagem->isValid()) {
            
            if ($produto->imagem && Storage::exists($produto->imagem)) {
                Storage::delete($produto->imagem);
            }
            
            $fotoPath = $request->imagem->store('produtos/img');
            $dataForm['imagem'] = $fotoPath;
        }
        
        //Altera os itens
        $update = $produto->update($dataForm);
        
        $produtos = $this->produtos->paginate($this->totalPage);

        //Verifica se realmente editou
        if($update)
            return view('produto.listagem', compact('produtos'));
        else 
            return redirect()->route('produto.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resposta = $this->produtos->find($id);

        if (!$resposta)
            return redirect()->back();

        if ($resposta->imagem && Storage::exists($resposta->imagem)) {
            Storage::delete($resposta->imagem);
        }

        $resposta->delete();       

        return redirect()->route('produtos.index')->with('sucesso', 'Cadastro excluído com sucesso.'); 
    }    
}
