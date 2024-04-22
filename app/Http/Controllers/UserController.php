<?php

namespace App\Http\Controllers;
session_start();

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


        public function store(Request $request)
        {
            if (User::where('email', $request->email)->exists()) {
                // Redirecionar de volta com erro se o e-mail já estiver em uso
                return redirect()->back()->withErrors(['error' => 'Não é possível cadastrar verifique os dados e tente novamente.']);
            }
            
            // Se o e-mail não estiver em uso, prossiga para criar o usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            // Você pode verificar se a criação foi bem-sucedida
            if (!$user) {
                return redirect()->back()->withErrors(['error' => 'Erro ao registrar o usuário']);
            }
            return redirect()->back()->with('success', 'Cadastro realizado com sucesso!');
            
        }
    /**
     * Display the specified resource.
     */
    public function show(string $email)
    {
        $user = User::where('email', $email)->first();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function login(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if ($user && Hash::check($request->password, $user->password)) {
        // Usuário existe e a senha está correta
        // Criar sessão para o usuário
        session(['user' => $user]);

        // Redirecionar para a página inicial
        return redirect()->route('home');
    } else {
        // Usuário não encontrado ou senha incorreta
        // Redirecionar de volta com uma mensagem de erro
        return redirect()->back()->withErrors(['error' => 'Credenciais inválidas. Por favor, verifique seu e-mail e senha.']);
    }
}
public function verifyEmail(Request $request){
    $user = User::where('email', $request->email)->first();
    if ($user) {
     return true;
    } else {
        return false;
    }
}
}
