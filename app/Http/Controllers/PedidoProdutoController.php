<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pedido $pedido)
    {
        // Busque todos os produtos disponíveis
        $produtos = Produto::all(); // Ajuste isso conforme a sua lógica

        return view('app.pedido_produto.create', [
            'pedido' => $pedido,
            'produtos' => $produtos, // Passe a lista de produtos para a view
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        //$pedido->produtos;
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required'
        ];

        $feedback = [
            'produto_id.exists' => 'O produto não existe.',
            'required' => 'O campo :attribute deve possuir um valor válido'
        ];

        $request->validate($regras, $feedback);

        /*$pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->get('produto_id'); // Corrigido para produto_id
        $pedidoProduto->save();*/

        /*$pedido->produtos()->attach(
            $request->get('produto_id'),
            [
                'quantidade' => $request->get('quantidade')
            ]
        );*/

        $pedido->produtos()->attach([
            $request->get('produto_id') => ['quantidade' => $request->get('quantidade')]
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        /*
        print_r($pedido->getAttributes());
        echo '<hr>';
        print_r($produto->getAttributes());
        */

        //echo $pedido->id.' - '.$produto->id;

        //convencional
        /*
        PedidoProduto::where([
            'pedido_id' => $pedido->id,
            'produto_id' => $produto->id
        ])->delete();
        */

        //detach (delete pelo relacionamento)
        //$pedido->produtos()->detach($produto->id);
        //produto_id

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
