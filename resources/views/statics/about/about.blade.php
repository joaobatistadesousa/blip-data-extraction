@section('title', 'Itechit | Sobre')
@extends('statics.layout')

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
    <div class="container">
    </div>

    <img src="https://itechit.com.br/wp-content/uploads/2023/09/img4.jpg" alt="about image itechit" id="about-image" class="mb-2">
    <h1>Sobre</h1>

    
    <p>
        Aqui na ITECH IT a inovação encontra a excelência em tecnologia da informação! Estamos dedicados a oferecer soluções de TI de vanguarda para impulsionar o sucesso e o crescimento sustentável de sua empresa. Aqui está um pouco mais sobre quem somos:

        Nossa Missão: Na ITECH, nossa missão é proporcionar soluções de TI que transcendem as expectativas, capacitando nossos clientes a atingirem seus objetivos comerciais com eficiência, segurança e inovação.

        O Que Nos Impulsiona: Somos apaixonados por tecnologia e impulsionados pela busca incessante pela excelência. Cada desafio é uma oportunidade para crescermos e oferecermos resultados excepcionais aos nossos clientes.
    </p>
    @endsection