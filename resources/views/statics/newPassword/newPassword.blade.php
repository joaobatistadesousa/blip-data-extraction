@extends('statics.layout')

@section('title', 'Itechit | Nova Senha')
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
            <h2 class="text-center mb-4">Criar Nova Senha</h2>
            <form action="{{ route('saveNewPassword') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="password" class="form-label">Nova Senha:</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Sua nova senha">
                </div>
                <div id="passwordStrong"></div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirmar Nova Senha:</label>
                    <input type="password" class="form-control" id="passwordAgain" name="passwordAgain" required placeholder="Confirme sua nova senha">
                    <input type="hidden" name="userId" id="userId" value="{{ $user->id }}">
                </div>

                <div id="message"></div>

                <button type="submit" class="btn btn-primary">Salvar Nova Senha</button>
            </form>
        </div>
    </div>
</div>
    @endsection
    @section('js')
    <script src="{{ asset('actions/passwordValidate.js') }}"></script>
@endsection

