@extends('statics.layout')

@section('title', 'Itechit')
@section('css')
    <link rel="stylesheet" href="{{ asset('styles/home.css') }}">
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
        <a class="nav-link" href="{{ route('login') }}">Entrar</a>
    </li>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section" id="boasVindas">
                <H1>Bem vindo a plataforma da Itechit Nome</H1>
                <p>Aqui voce pode obter uma gama de informações sobre seu contato Inteligente.</p>
                </div>
                
                <div class="section" id="recebidas">
                  <p class="title">  Menssagem  Recebidas</p>
                    <p>como essa funcionalidade você poderá Obter a quantidade de menssagens recebidas separado por datas com um intervalo de tempo maximo de 94 dias.</p>
                </div>
                <div class="section" id="enviadas">
                    
                    <p class="title"> Menssagem Enviadas</p>
                        <p>como essa funcionalidade você poderá Obter a quantidade de menssagens enviadas separado por datas com um intervalo de tempo maximo de 94 dias.</p>



                </div>
                <div class="section" id="relatorio">
                    
                    <p class="title">Relatorio de eventos Personalizados</p>
                        <p>como essa funcionalidade você poderá Obter a quantidade de eventos personalizados as ações respostas das menssagens pelos clientes.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
