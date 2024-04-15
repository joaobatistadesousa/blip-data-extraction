@extends('statics.layout')
@section('title', 'Itechit | Login')
@section('css')
    <link rel="stylesheet" href="{{ asset('styles/login.css') }}">
    @endsection
@section('menu-itens')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('web.home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('about') }}">Sobre nós</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('contact') }}">Contato</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Cadastrar</a>
    </li>
   @endsection
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Login Administrativo</h2>
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
            <form action="{{ route('verifyLogin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Seu email" name="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" placeholder="Sua senha" name="password">
                </div>
                <div class="mb-3">
                    <div class="forgot-password">
                        <a href="{{ route('forgot-password') }}">Esqueceu sua senha?</a>
                    </div>
                </div>
                <div class="mb-3">
                    <a href="{{ route('register') }}">Crie sua conta aqui</a>
                    </div>
                <button type="submit" class="btn btn-primary" id="loginButton">Entrar</button>
            </form>
        </div>
    </div>
</div>
@endSection
