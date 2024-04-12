<?php
include_once 'UserDao.php';
session_start();
class UserAuthentication
{
    private $username;
    private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function authenticate()
    {
        $userDao = new UserDao();
        $user= $userDao->findOne($this->username);

        if($user && password_verify($this->password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
            
        }
        return false;
        
        
    }
}