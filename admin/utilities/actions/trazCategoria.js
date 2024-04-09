document.addEventListener('DOMContentLoaded', function () {
    const form_params = document.querySelector('#form_params');
    const bot_key = document.querySelector('#bot_key');
    const category = document.querySelector('#category');

    // Função para fazer a requisição AJAX e preencher o select
    function fetchAndPopulateCategories(bot_key_value) {
        const url = "https://msging.net/commands";
        const headers = {
            'Authorization': bot_key_value,
            'Content-Type': 'application/json'
        };

        const body = {
            "id": "{{$guid}}",
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
            // Limpa as opções atuais do select
            category.innerHTML = '';
            // Adiciona as novas opções do select baseado nos dados recebidos
            data.resource.items.forEach(item => {
                const optionElement = document.createElement('option');
                optionElement.value = item.category;
                optionElement.text = item.category;
                category.appendChild(optionElement);
            });
        })
        .catch(error => console.error('Erro ao fazer a requisição:', error));
    }

    // Chamada inicial para preencher o select com as opções padrão
    fetchAndPopulateCategories(bot_key.value);

    bot_key.addEventListener('change', function () {
        const bot_key_value = bot_key.value;
        fetchAndPopulateCategories(bot_key_value);
    });
});
