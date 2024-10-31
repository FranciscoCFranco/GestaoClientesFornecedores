<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $erro = '';

        if ($request->get('erro') == 1) {
            $erro = 'Usuário e/ou senha não existem';
        }

        if ($request->get('erro') == 2) {
            $erro = 'Necessário realizar login para ter acesso a página';
        }

        return view('site.login', ['titulo' => 'Login', 'erro' => $erro]);
    }

    public function autenticar(Request $request)
    {
        // Regras de validação
        $request->validate([
            'usuario' => 'required|email',
            'senha' => 'required'
        ], [
            'usuario.required' => 'O campo usuário (e-mail) é obrigatório',
            'usuario.email' => 'O campo usuário deve ser um e-mail válido',
            'senha.required' => 'O campo senha é obrigatório'
        ]);

        // Credenciais usando 'email' e 'password'
        $credentials = [
            'email' => $request->input('usuario'),
            'password' => $request->input('senha')
        ];

        // Tentativa de autenticação
        if (Auth::attempt($credentials)) {
            return redirect()->route('app.home');
        }

        // Autenticação falhou
        return redirect()->route('site.login', ['erro' => 1]);
    }


    public function sair()
    {
        Auth::logout(); // Usando o método do Laravel para logout
        return redirect()->route('site.index');
    }
}
