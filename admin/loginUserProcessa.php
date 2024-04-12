<?php
include_once './database/UserAuthentication.php';
$email=$_POST['email'];
$password= $_POST['password'];
$auth=new UserAuthentication($email, $password);
if ($auth->authenticate()) {
    header("Location: index.php");
}
else {
    echo "Login falhou";
}