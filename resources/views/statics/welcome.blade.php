@extends('statics.layout')

@section('title', 'Itechit')

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
                <h1>Bem vindo ao Itechit</h1>
            </div>
        </div>
    </div>
@endsection
