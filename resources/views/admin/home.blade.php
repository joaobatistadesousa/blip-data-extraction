@if(!session('user'))
    <script>
        window.location.href = "{{ route('login') }}";
    </script>
@endif

@extends('statics.layout')
@section('title', 'Itechit | Admin')

@section('menu-itens')
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('home') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('registerClient') }}">Cadastrar Cliente</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('registerSmartContract') }}">Cadastrar Contrato inteligente</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('saveSentMessage') }}">Menssagens Enviadas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('saveReceivedMessage') }}">Menssagens Recebidas</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('saveEventDetails') }}">Eventos Personalizados</a>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('saveDaus') }}">Infos DAO</a>
        </li>
    </li>
    @endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

    @endsection
