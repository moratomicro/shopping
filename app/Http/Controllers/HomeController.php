<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $produtos;
    private $totalPage = 6;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Produto $produtos)
    {
        $this->middleware('auth');
        $this->produtos = $produtos;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function inicio()
    {
        $title = 'Vitrine';
        $produtos = $this->produtos->paginate($this->totalPage);
        
        return view('welcome', compact('produtos', 'title'));        
    }
}
