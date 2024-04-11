<?php
include_once "./MysqlConection.php";
include_once "../request/eventDetails.php";
include_once "../utilities/retoneDates.php";

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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $bot_key = $_POST["bot_key"];
            $dates = calcularDatas();
            $start_date = $dates["start_date"];
            $end_date = $dates["end_date"];
            $quantity_of_events = 10;
            $event_name =$_POST["category"];


            $idBot = $_POST["idBot"]; 

            

             $eventDetails = new EventDetails();
             $result = $eventDetails->EventDetails($bot_key, $start_date, $end_date, $quantity_of_events, $event_name);
             $response = json_decode($result, true);
             if (isset($response['resource']['items'])) {
                 $items = $response['resource']['items'];
                 $inserted = 0;
                 foreach ($items as $item) {
                     if ($this->insertEventDetailsDao($idBot, $item, false)) {
                         $inserted++;
                     }
                 }
                 if ($inserted > 0) {
                     echo "Registros cadastrados com sucesso! Quantidade: " . $inserted;
                 } else {
                     echo "Nenhum registro inserido.";
                 }
             } else {
                 echo "Não foi possível obter os itens do recurso.";
             }
         }
     }

     private function insertEventDetailsDao($idSmartContact, $item, $displaySuccessMessage = true)
     {
         if (isset($item['storageDate']) && isset($item['category']) && isset($item['action']) && isset($item['count'])) {
             $storageDate = date('Y-m-d H:i:s', strtotime($item['storageDate']));
             $category = $item['category'];
             $action = $item['action'];
             $count = $item['count'];

             if (!$this->checkExistingRecord($idSmartContact, $storageDate, $category, $action, $count)) {
                 $sql = "INSERT INTO event_details (idSmartContact, storageDate, category, action, count) VALUES (?, ?, ?, ?, ?)";
                 $stmt = $this->connection->prepare($sql);
                 $stmt->execute([$idSmartContact, $storageDate, $category, $action, $count]);
                 if ($displaySuccessMessage) {
                     echo "Registro cadastrado com sucesso!";
                 }
                 return true; // Retorna true para indicar que o registro foi inserido com sucesso
             } else {
                 // Se o registro já existe, não exibe a mensagem de sucesso
                 return false;
             }
         } else {
             echo "Chaves não definidas no array \$item.";
             return false;
         }
     }

     private function checkExistingRecord($idSmartContact, $storageDate, $category, $action, $count)
     {
         $sql = "SELECT COUNT(*) FROM event_details WHERE idSmartContact = ? AND storageDate = ? AND category = ? AND action = ? AND count = ?";
         $stmt = $this->connection->prepare($sql);
         $stmt->execute([$idSmartContact, $storageDate, $category, $action, $count]);
         $count = $stmt->fetchColumn();
         return $count > 0;
     }

     // Função para obter o idSmartContact com base no bot_key (Você precisa implementar essa lógica)
 }

$EventDetailsDao = new EventDetailsDao();
$EventDetailsDao->insert();
?>
