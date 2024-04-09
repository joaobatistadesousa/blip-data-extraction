<?php
include_once "../../internal/database/MysqlConection.php";
include_once "../request/eventDetails.php";

class EventDetailsDao
{
    private $connection;

    public function __construct()
    {
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }
    public function insert()
    {
        $eventDetails = new EventTrack();
        $result = $eventDetails->getAllEvents();
    
        $items = json_decode($result, true);
        foreach ($items as $item) {
            $storageDate = date('Y-m-d H:i:s', strtotime($item['storageDate']));
            $category = $item['category'];
            $action = $item['action'];
            $count = $item['count'];
    
            $sql = "INSERT INTO event_details (storageDate, category, action, count) VALUES ('$storageDate', '$category', '$action', '$count')";
            
            // Executar a consulta SQL
            if ($this->connection->query($sql) === TRUE) {
                echo "Registro inserido com sucesso!";
            } else {
                echo "Erro ao inserir registro: " . $this->connection->error;
            }
        }
    }
        
}

$EventDetailsDao = new EventDetailsDao();
$EventDetailsDao->insert();
