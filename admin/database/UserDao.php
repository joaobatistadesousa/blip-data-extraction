<?php
include_once "MysqlConection.php";
 class UserDao 
{

    public function __construct()
    {
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }

    public function insert($name, $email, $password){
        try {
            $sql = "INSERT INTO user (name, email, password) VALUES (?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $passwordhash= password_hash($password, PASSWORD_DEFAULT);
            $user = $stmt->execute([$name, $email, $passwordhash]);
            
            return true;
        } catch (PDOException $e) {
            
            return false;
            die();
            
        }
        
    }
    function findMany(){
        $sql = "SELECT * FROM user";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $users;
    }

    function findOne($email){
        $sql = "SELECT * FROM user WHERE email = ?  LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    function update_code($id, $code){
        $sql = "UPDATE user SET code = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $user = $stmt->execute([$code, $id]);
        return $user;
    }
    function findCode($code){
        $sql = "SELECT * FROM user WHERE code = ?  LIMIT 1";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$code]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
    
    function updatePassword($id, $password){
        $sql = "UPDATE user SET password = ? WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $user = $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $id]);
        return $user;
    }
}
