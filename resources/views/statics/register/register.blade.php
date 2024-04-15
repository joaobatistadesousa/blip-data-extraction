@extends('statics.layout')
@section('title', 'Itechit | Cadastro de Usuário')
@section('menu-itens')
@section('css')
    <link rel="stylesheet" href="{{ asset('styles/register.css') }}">
    @endsection
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('web.home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">Sobre</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">Contato</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
    </li>
    @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Cadastro Administrativo</h2>
            @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <!-- Adicione esta seção no seu arquivo Blade onde você deseja exibir a mensagem -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->first('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <form action="{{route('saveUser') }}" id="registerForm" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="name" placeholder="Seu nome" name="name" autofocus>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Seu email" name="email" autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Sua senha" name="password">
                </div>
                <div id="passwordStrong">

                </div>

                <div class="mb-3">
                    <label for="passwordAgain" class="form-label">Confirmar Senha</label>
                    <input type="password" class="form-control" id="passwordAgain" placeholder="Confirme sua senha" name="passwordAgain">
                <div id="message">
                </div>
                <a href="{{ route('login') }}">Já Possui Conta? Clique Aqui</a>
                <div class="mb-3">

                <button type="submit" class="btn btn-primary" id="registerButton">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('actions/passwordValidate.js') }}"></script>
@endsection
