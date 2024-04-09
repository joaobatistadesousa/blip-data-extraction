<?php
include_once "MysqlConection.php";
class SmartContactDao{
    private $connection;

    public function __construct(){
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }

    public function insert($botKey, $clientId){
        try {
            $sql = "INSERT INTO smartContact (botKey, clientId) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$botKey, $clientId]);
            return true;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function findOne($clientId){
        try {
            $sql = "SELECT * FROM smartContact WHERE clientId = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$clientId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function findMany(){
        try {
            $sql = "SELECT * FROM smartContact";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function findManyByClientId($clientId){
        try {
            $sql = "SELECT * FROM smartContact WHERE clientId = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$clientId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function findOneByClientId($clientId){
        try {
            $sql = "SELECT botKey FROM smartContact WHERE clientId = ? LIMIT 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$clientId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['botKey'];
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

}

$bot= new SmartContactDao();
echo json_encode( $bot->findMany());