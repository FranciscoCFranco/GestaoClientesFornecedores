<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
  public function contato(Request $request)
  {
    $motivo_contatos = MotivoContato::all();
    return view('site.contato', ['titulo' => 'Contato (teste)', 'motivo_contatos' => $motivo_contatos]);
  }

  public function salvar(Request $request)
  {
    // Regras de validação
    $regras = [
      'nome' => 'required|min:3|max:40',
      'telefone' => 'required',
      'email' => 'email',
      'motivo_contatos_id' => 'required',
      'mensagem' => 'required|max:2000'
    ];

    // Mensagens de feedback
    $feedback = [
      'nome.required' => 'Por favor, insira seu nome.',
      'nome.min' => 'O nome deve conter pelo menos 3 caracteres.',
      'nome.max' => 'O nome pode ter no máximo 40 caracteres.',
      'telefone.required' => 'Por favor, insira seu telefone.',
      'email.email' => 'Insira um endereço de e-mail válido.',
      'motivo_contatos_id.required' => 'Escolha um motivo de contato.',
      'mensagem.required' => 'Por favor, insira sua mensagem.',
      'mensagem.max' => 'A mensagem pode ter no máximo 2000 caracteres.'
    ];

    $request->validate($regras, $feedback);

    SiteContato::create($request->all());
    return redirect()->route('site.index');
  }
}
