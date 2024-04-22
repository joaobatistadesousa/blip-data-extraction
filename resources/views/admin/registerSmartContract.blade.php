
@extends('statics.layout')
@section('title', 'Itechit | Admin | Cadastrar Contrato inteligente')

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
                <h1>Cadastrar um novo bot</h1>
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
       
        <form action="{{ route('saveSmartContractInSystem')}}" method="post" id="form_params">
            @csrf
            <div class="mb-3">
                <label for="">nome cliente</label>
                <select name="client_id" id="client_id" class="form-select" required>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->customerName }}</option>
                    @endforeach

                </select>
                <div class="mb-3">
                    <label for="bot_key" class="form-label">
                        Chave de autorizacão do bot
                    </label>
                    <input type="text" class="form-control" id="bot_key" name="bot_key" placeholder="Informe o bot key" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="bot_name" class="form-label"> Nome do bot</label>
                <input type="text" class="form-control" id="bot_name" name="bot_name" placeholder="Nome do bot" required>
            </div>
                <button type="submit" class="btn btn-primary">Cadastrar cadastro de um novo bot</button>
        </form>
    </div>

    </div>
    </div>

@endsection
