<?php
include_once "./database/UserDao.php";
$userName= $_POST["name"];
$userEmail= $_POST["email"];
$userPassword= $_POST["password"];
$userDao= new UserDao();
$response=$userDao->insert($userName, $userEmail, $userPassword);
if($response){
    echo "Usário inserido com sucesso";
}else{
    echo "Erro ao inserir o usuário";
}

?>