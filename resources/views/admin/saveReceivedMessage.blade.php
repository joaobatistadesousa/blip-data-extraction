@extends('statics.layout')
@section('title', 'Itechit | Admin | mensagens recebidas')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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
    </li>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Adicione esta seção no seu arquivo Blade onde você deseja exibir a mensagem -->
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

                <form action="{{ route('saveReceivedMessageRequest') }}" method="post" id="form_params">
                    @csrf
                    <button type="submit" class="btn btn-primary">Cadastrar dados</button>
                </form>
            </div>
        </div>
    </div>
@endsection
