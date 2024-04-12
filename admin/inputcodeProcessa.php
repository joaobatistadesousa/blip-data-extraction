<?php
include_once './database/UserDao.php';	
$userDao= new UserDao();

$codigo = $_POST['codigo'];
$user = $userDao->findCode($codigo);
if($user){
header("Location: ./createNewPassword.php?id=$user[id]");
}else{
  header('Location: ./loginUser.php');
}