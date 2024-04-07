<?php
class MysqlConection
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    private function connect()
    {
        $db_host = "localhost";
        $db_username = "root";
        $db_password = "";
        $db_name = "extracao_dados";

        $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";

        $options = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            return new PDO($dsn, $db_username, $db_password, $options);
        } catch (PDOException $e) {
            exit('Ocorreu um erro na conexão com o banco de dados: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
