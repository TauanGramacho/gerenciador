<?php

namespace App\Http\Controllers;

use App\Models\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
        $senha = $request->senha;

        $usuarios = usuario::where('email', '=', $usuario)->where('senha', '=', $senha)->first();

        if ($usuarios !== null) { // Verifica se $usuarios não é null
            @session_start();
            $_SESSION['id_usuario'] = $usuarios->id;
            $_SESSION['nome_usuario'] = $usuarios->nome;
            $_SESSION['nivel_usuario'] = $usuarios->nivel;
            $_SESSION['cpf_usuario'] = $usuarios->cpf;

            if ($_SESSION['nivel_usuario'] == 'admin') {
                return view('inicial');
            }
            // if($_SESSION['nivel_usuario'] == 'instrutor'){
            //     return view('painel-instrutor.index');
            // }
            // if($_SESSION['nivel_usuario'] == 'recep'){
            //     return view('painel-recep.index');
            // }

        } else {
            return redirect()->back()->withErrors(['message' => 'Usuário ou senha incorretos!!, Tente novamente!!']);
        }
        
        return view('login');
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('inicial'));
    }
}
