<?php
include_once 'MysqlConection.php';
class ClientDao
{
    private $connection;

    public function __construct()
    {
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }

    public function insert($customerName, $planName)
    {
        try {
            $sql = "INSERT INTO client (customerName, planName) VALUES (?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$customerName, $planName]);
            echo "Cliente inserido com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao inserir cliente: " . $e->getMessage();
        }
    }

    public function findOne($customerName)
    {
        try {
            $sql = "SELECT * FROM client WHERE customerName = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$customerName]);
            $client = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($client) {
                return $client;
            } else {
                echo "Cliente não encontrado.";
                return null;
            }
        } catch (PDOException $e) {
            echo "Erro ao buscar cliente: " . $e->getMessage();
            return null;
        }
    }

    public function findMany()
    {
        try {
            $sql = "SELECT * FROM client";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $clients;
        } catch (PDOException $e) {
            echo "Erro ao buscar clientes: " . $e->getMessage();
            return null;
        }
    }
}
