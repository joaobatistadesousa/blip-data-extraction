<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Buscar Relatórios personalizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container mt-5">
    <a href="index.php" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
</svg></a>
        <h1>Buscar Relatórios personalizados</h1>
        <form action="./internal/database/EventDetailsDao.php" method="post" id="form_params">
            <div class="mb-3">
                <label for="bot_key" class="form-label">Chave de autorizacão do bot</label>
                <input type="text" class="form-control" id="bot_key" name="bot_key" placeholder="Informe o bot key">
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Data inicial</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Data final</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
            <div class="mb-3">
                <label for="quantity_of_events" class="form-label">Quantidade de eventos</label>
                <input type="number" class="form-control" id="quantity_of_events" name="quantity_of_events" placeholder="Informe a quantidade de eventos a serem retornados">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="js/verifyIsBlank.js"></script>

</body>
</html>
