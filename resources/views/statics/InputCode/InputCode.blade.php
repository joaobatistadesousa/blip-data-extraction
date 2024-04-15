@extends('statics.layout')

@section('title', 'Itechit | Código de Recuperação')
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Código de Recuperação</h2>
            <form action="{{ route('VerifyCodeEmailRecovery') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="codigo" class="form-label">Código:</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Seu Código de Recuperação recebido pelo email" required>
                </div>
                <button type="submit" class="btn btn-primary">Verificar Código</button>
            </form>
        </div>
    </div>
</div>
@endSection
