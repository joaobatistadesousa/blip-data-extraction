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
    <title>Extração de Dados</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/index.css">

    <style>
        
    </style>
</head>
<body>
    <nav>
        <a href="RegistrationClient.php">cadastrar Novo cliente</a>
        <a href="registration_new_bot.php">Cadastrar Novo Bot</a>
        <a href="setMessageAdmin.php">Mensagens Enviadas</a>
        <a href="received_messages.php">Mensagens Recebidas</a>
        <a href="event_details.php">Relatórios Personalizados</a>
    </nav>
</body>
</html>
