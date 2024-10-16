<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
  public function index()
  {
    return view('app.fornecedor.index');
  }

  public function listar(Request $request)
  {
    $fornecedores = Fornecedor::where('nome', 'like', '%' . $request->input('nome') . '%')
      ->where('site', 'like', '%' . $request->input('site') . '%')
      ->where('uf', 'like', '%' . $request->input('uf') . '%')
      ->where('email', 'like', '%' . $request->input('email') . '%')
      ->paginate(2);

    return view('app.fornecedor.listar', ['fornecedores' => $fornecedores, 'request' => $request->all()]);
  }

  public function adicionar(Request $request)
  {
    $msg = '';

    if ($request->input('_token') != '') {
      $regras = [
        'nome' => 'required|min:3|max:40',
        'site' => 'required',
        'uf' => 'required|min:2|max:2',
        'email' => 'email'
      ];

      $feedback = [
        'required' => 'O campo :attribute deve ser preenchido',
        'nome.min' => 'O campo nome deve ter no mínimo 3 caracteres',
        'nome.max' => 'O campo nome deve ter no máximo 40 caracteres',
        'uf.min' => 'O campo uf deve ter no mínimo 2 caracteres',
        'uf.max' => 'O campo uf deve ter no máximo 2 caracteres',
        'email.email' => 'O campo e-mail não foi preenchido corretamente'
      ];

      $request->validate($regras, $feedback);

      if ($request->input('id') == '') {
        // Criar novo fornecedor
        $fornecedor = new Fornecedor();
        $fornecedor->fill($request->all());
        $fornecedor->save();
        $msg = 'Cadastro realizado com sucesso';
        $id = $fornecedor->id;
      } else {

        $fornecedor = Fornecedor::find($request->input('id'));
        $update = $fornecedor->update($request->all());

        if ($update) {
          $msg = 'Edição realizada com sucesso';
        } else {
          $msg = 'Erro ao tentar atualizar o registro';
        }
        $id = $fornecedor->id;
      }

      return redirect()->route('app.fornecedor.editar', ['id' => $id, 'msg' => $msg]);
    }

    return view('app.fornecedor.adicionar', ['msg' => $msg]);
  }

  public function editar($id, $msg = '')
  {
    $fornecedor = Fornecedor::find($id);

    return view('app.fornecedor.adicionar', ['fornecedor' => $fornecedor, 'msg' => $msg]);
  }

  public function excluir($id)
  {

    Fornecedor::find($id)->delete();

    return redirect()->route('app.fornecedor')->with('success', 'Fornecedor excluído com sucesso.');


    return redirect()->route('app.fornecedor')->with('error', 'Fornecedor não encontrado.');
  }
}
