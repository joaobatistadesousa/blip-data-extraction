<?php
session_start();
include_once './database/UserDao.php';	
include_once './utilities/Sendemail.php';
$email=$_POST['email'];
$userDao=new UserDao();
$user=$userDao->findOne($email);
if($user!=null){
    $code=rand(100000, 999999);
    $userDao->update_code($user['id'], $code);
    $subject="Recuperação de senha";
    $body="seu codigo de recuperação e: $code";
    $sendEmail=new Sendemail();
    $sendEmail->sendMail($email, $subject, $body);
        $_SESSION["reset_code"]="reset_code";
    header('Location: inputcode.php');

}
