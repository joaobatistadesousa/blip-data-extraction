<?php
include_once "./MysqlConection.php";
include_once "../requests/eventDetails.php";

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
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $quantity_of_events = $_POST["quantity_of_events"];

            $eventDetails = new EventDetails();
            $result = $eventDetails->EventDetails($bot_key, $start_date, $end_date, $quantity_of_events);

            $response = json_decode($result, true);
            $items = $response['resource']['items'];

            $inserted = 0;
            foreach ($items as $item) {
                var_dump($item);
                if ($this->insertEventDetailsDao($bot_key, $item, false)) {
                    $inserted++;
                }
            }

            if ($inserted > 0) {
                echo "Registros cadastrados com sucesso! Quantidade: " . $inserted;
            } else {
                echo "Nenhum registro inserido.";
            }
        }
    }

    private function insertEventDetailsDao($botKey, $item, $displaySuccessMessage = true)
    {
        if (isset($item['storageDate']) && isset($item['expiration']) && isset($item['customerId'])) {
            $storageDate = date('Y-m-d H:i:s', strtotime($item['storageDate']));
            $expiration = date('Y-m-d', strtotime($item['expiration']));
            $customerId = $item['customerId'];

            if (!$this->checkExistingRecord($botKey, $storageDate, $expiration, $customerId)) {
                $sql = "INSERT INTO event_details (bot_key, storageDate, expiration, customerId) VALUES (?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$botKey, $storageDate, $expiration, $customerId]);
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

    private function checkExistingRecord($botKey, $storageDate, $expiration, $customerId)
    {
        $sql = "SELECT COUNT(*) FROM event_details WHERE bot_key = ? AND storageDate = ? AND expiration = ? AND customerId = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$botKey, $storageDate, $expiration, $customerId]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}

$EventDetailsDao = new EventDetailsDao ();
$EventDetailsDao->insert();
?>
