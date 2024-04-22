@extends('statics.layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('title', 'Itechit | Recuperar Senha')
@section('menu-itens')
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
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="text-center mb-4">Recuperação de Senha</h2>
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

        <form action="{{ route('sendEmailRecoveryPassword') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Seu email" required>
            </div>
            <button type="submit" class="btn btn-primary" id="recoveryButton">Recuperar Senha</button>
        </form>
    </div>
</div>
</div>
@endSection
