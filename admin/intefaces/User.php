<?php 
interface User{
    function User($email,$senha);
    function getUser($email);
    function update($email, $password);   
}