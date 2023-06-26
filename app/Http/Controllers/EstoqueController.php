<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueResquest;
use App\Models\Estoque;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class EstoqueController extends Controller
{
    public function index()
    {
        $lista = Estoque::all();

        return view('estoque.index', [
            'lista' => $lista,
        ]);
    }

    public function busca(Request $form) {
        $busca = $form->busca;
        $lista = Estoque::where('nome', 'LIKE', "%{$busca}%")->get();

        return view('estoque,index',['lista' => $lista,]);
    }

    public function adicionar()
    {
        return view('estoque.adicionar');
    }

    public function adicionarGravar(EstoqueResquest $form)
    {
        $dados = $form->validated();
        Estoque::create($dados);
        return redirect('estoque');
    }

    public function editarGravar(EstoqueResquest $form)
    {
        $dados = $form->validated();
        $estoque = Estoque::find($dados['id']);
        $estoque->fill($dados);
        $estoque->save();
        return redirect('estoque');
    }

    public function editar(Estoque $estoque){
        return view('estoque.adicionar', ['editar' => $estoque,]);
    }

    public function apagar(Estoque $estoque) {
        //se for delete, apaga no banco. se não, mostra a tela de conformação
        if (request()->isMethod('DELETE')) {
            $estoque->delete();
            return redirect('estoque')->with('sucesso','Item apagado com sucesso.');
        }

        return view ('estoque.apagar', ['estoque' => $estoque,]);
    }
    
}
