

@extends('statics.layout')
@section('title', 'Itechit | Admin | Cadastrar Cliente')

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
                <form action="{{route('saveClient')}}" method="post" id="form_params">
                    @csrf
                    <div class="mb-3">
                        <label for="ClientName">Nome do cliente</label>
                        <div class="mb-3">
                        <input type="text" class="form-control" id="ClientName" name="ClientName" placeholder="nome do cliente" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="planClient" class="form-label"> Qual o plano do cliente</label>
                        <input type="text" class="form-control" id="planClient" name="planClient" placeholder="Nome do plano" required>
                    </div>
                        <button type="submit" class="btn btn-primary">Cadastrar cadastro de um novo bot</button>
                </form>
                </div>

            </div>
        </div>
    </div>

@endsection
