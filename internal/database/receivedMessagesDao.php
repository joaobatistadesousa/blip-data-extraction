<?php
include_once "./MysqlConection.php";
include_once "../requests/receivedMessages.php";

class ReceivedMessageDao
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
            $bot_key = $_POST['bot_key'];
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
    
            $receivedMessage = new ReceivedMessages();
            $result = $receivedMessage->receivedMessages($bot_key, $start_date, $end_date);
    
            $response = json_decode($result, true);
            $items = $response['resource']['items'];
    
            $inserted = 0;
            foreach ($items as $item) {
                if ($this->insertReceivedMessage($bot_key, $item, false)) {
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
    
    private function insertReceivedMessage($botKey, $item, $displaySuccessMessage = true)
    {
        if (isset($item['intervalStart']) && isset($item['intervalEnd']) && isset($item['count'])) {
            $startDate = date('Y-m-d H:i:s', strtotime($item['intervalStart']));
            $endDate = date('Y-m-d H:i:s', strtotime($item['intervalEnd']));
    
            if (!$this->checkExistingRecord($botKey, $startDate, $endDate)) {
                $sql = "INSERT INTO received_messages (botKey, start_date, end_date, count) VALUES (?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$botKey, $startDate, $endDate, $item['count']]);
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

    private function checkExistingRecord($botKey, $startDate, $endDate)
    {
        $sql = "SELECT COUNT(*) FROM received_messages WHERE botKey = ? AND start_date = ? AND end_date = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$botKey, $startDate, $endDate]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }
}

$receivedMessageDao = new ReceivedMessageDao();
$receivedMessageDao->insert();
?>
