<?php
session_start();

if(!isset($_SESSION['user'] )){
    header('Location: loginUser.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Relatórios personalizados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="stylesheet" href="../css/style.css"> 
</head>

<body>
    <div class="container mt-5">
        <a href="index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
            </svg>
        </a>

        <h1>Buscar informações sobre eventos</h1>
        <form action="./database/event_detailsDao.php" method="post" id="form_params">
            <label for="bot_key">Selecionar bot:</label>
            <select name="bot_key" id="bot_key">
                <?php
                include_once './database/SmartContactDao.php';
                $smartContactDao = new SmartContactDao();
                $smartContacts = $smartContactDao->findMany();


                foreach ($smartContacts as $smartContact) {
                    echo '<option value="' . $smartContact['botKey'] . '">' . $smartContact['name'] . '</option>';
                }

                ?>

            </select>
            <div class="mb-3">
                <label for="category">Selecionar categoria:</label>
                <select name="category" id="category">
                    <option value="">Selecione uma categoria</option>
                </select>
            </div>
            <input type="hidden" id="idBot" name="idBot" value="<?php echo $smartContact['id']; ?>">

            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="utilities/actions/trazCategoria.js"></script>
</body>

</html>