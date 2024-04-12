<?php
include_once './database/UserDao.php';	
$idUser= $_GET["id"];
$password= $_POST["password"];
$userDao= new UserDao();
$response=$userDao->updatePassword($idUser, $password);
echo $response;