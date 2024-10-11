<?php

namespace App\Http\Controllers;

use App\Produto;
use App\Unidade;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $regras = [];

    $feedback = [];

    $produtos = Produto::paginate(10);

    return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    $unidades = Unidade::all();
    return view('app.produto.create', ['unidades' => $unidades]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function store(Request $request)
  {
    $regras = [
      'nome' => 'required|min:3|max:100',
      'descricao' => 'required|min:3|max:2255',
      'peso' => 'required|numeric',
      'unidade_id' => 'exists:unidades,id'
    ];

    $feedback = [
      'required' => 'O campo :attribute é obrigatório',
      'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
      'nome.max' => 'O campo nome deve ter no máximo 100 caracteres',
      'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres',
      'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres',
      'peso.numeric' => 'O campo peso deve ser um número',
      'unidade_id.exists' => 'A unidade de medida selecionada não existe'
    ];

    $request->validate($regras, $feedback);

    Produto::create($request->all());

    return redirect()->route('produto.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Produto  $produto
   * @return \Illuminate\Http\Response
   */
  public function show(Produto $produto)
  {
    return view('app.produto.show', ['produto' => $produto]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Produto  $produto
   * @return \Illuminate\Http\Response
   */
  public function edit(Produto $produto)
  {
    $unidades = Unidade::all();
    return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Produto  $produto
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Produto $produto)
  {
    $regras = [
      'nome' => 'required|min:3|max:40',
      'descricao' => 'required|min:3|max:2000',
      'peso' => 'required|integer',
      'unidade_id' => 'exists:unidades,id'
    ];

    $feedback = [
      'required' => 'O campo :attribute é obrigatório.',
      'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres.',
      'nome.max' => 'O campo nome deve ter no máximo 40 caracteres.',
      'descricao.min' => 'O campo descrição deve ter no mínimo 3 caracteres.',
      'descricao.max' => 'O campo descrição deve ter no máximo 2000 caracteres.',
      'peso.integer' => 'O campo peso deve ser um número inteiro.',
      'unidade_id.exists' => 'A unidade de medida selecionada é inválida.'
    ];

    $request->validate($regras, $feedback);

    $produto->update($request->all());

    return redirect()->route('produto.index')->with('success', 'Produto atualizado com sucesso!');
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Produto  $produto
   * @return \Illuminate\Http\Response
   */
  public function destroy(Produto $produto)
  {
    $produto->delete(); // Deleta o produto
    return redirect()->route('produto.index')->with('success', 'Produto excluído com sucesso!');
  }
}
