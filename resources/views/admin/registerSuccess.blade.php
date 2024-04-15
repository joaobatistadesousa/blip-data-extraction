

@extends('statics.layout')
@section('title', 'Itechit | sucesso ao cadastrar')
@section('menu-itens')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('web.home') }}">Home</a>
    </li>
    <li class="nav-item">

    @endsection
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
                <h1>Obrigado por se cadastrar na Itechit</h1>
                <p>Agora você pode obter uma gama de informações sobre seu contato Inteligente.</p>
                <p>faça login para acessar aproveitar todos os nossos serviços</p>
            </div>
        </div>
    </div>
@endSection
