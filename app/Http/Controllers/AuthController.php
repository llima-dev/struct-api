<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para login de usuário
    public function login(Request $request)
    {
        // Validação dos dados
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Retorna erros de validação
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        // Verifica se as credenciais estão corretas
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            // Criação do token de autenticação
            $token = $user->createToken('API Token')->plainTextToken;

            // Retorna o token do usuário
            return response()->json(['token' => $token], 200);
        }

        // Caso as credenciais estejam erradas
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    // Método para obter os dados do usuário autenticado
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
