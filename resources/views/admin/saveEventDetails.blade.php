

@extends('statics.layout')
@section('title', 'Itechit | Admin | Eventos Personalizados')

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
                <h1>Eventos Personalizados</h1>
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
                <form action="{{ route('saveEventDetailsRequest')}}" method="post" id="form_params">
                    @csrf
                    <label for="bot_key" class="form-label">Selecionar bot:</label>
                    <select name="bot_key" id="bot_key" class="form-select" aria-label="Selecionar bot">
                        @foreach ($bots as $bot)
                            <option value="{{ $bot->botKey }}" data-id="{{ $bot->id }}">{{ $bot->name }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="idBot" id="idBot">

                    <div class="mb-3">
                        <label for="category" class="form-label">Selecionar categoria:</label>
                        <select name="category" id="category" class="form-select" aria-label="Selecionar categoria">

                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>


                </div>

            </div>
        </div>
    </div>

@endsection
@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const bot_key = document.querySelector('#bot_key');
    const idBot = document.querySelector('#idBot');
    const category = document.querySelector('#category');

    function generateGuid() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            const r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }

    function fetchAndPopulateCategories(bot_key_value) {
        const url = "https://msging.net/commands";
        const headers = {
            'Authorization': bot_key_value,
            'Content-Type': 'application/json'
        };

        const body = {
            "id": generateGuid(),
            "to": "postmaster@analytics.msging.net",
            "method": "get",
            "uri": "/event-track/"
        };

        fetch(url, {
            method: 'POST',
            headers: headers,
            body: JSON.stringify(body)
        })
        .then(response => response.json())
        .then(data => {
            data.resource.items.forEach(item => {
                const optionElement = document.createElement('option');
                optionElement.value = item.category;
                optionElement.text = item.category;
                category.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Erro ao fazer a requisição:', error));
    }

    // Atualiza o valor de idBot e categorias ao mudar de bot
    bot_key.addEventListener('change', function () {
        const selectedBot = bot_key.options[bot_key.selectedIndex];
        idBot.value = selectedBot.getAttribute('data-id'); // Atualiza o valor de idBot
        fetchAndPopulateCategories(selectedBot.value); // Atualiza as categorias
    });

    // Chamada inicial para preencher o idBot e as categorias
    if (bot_key.selectedIndex >= 0) {
        bot_key.dispatchEvent(new Event('change'));
    }
});

</script>
@endsection
