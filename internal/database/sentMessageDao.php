
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Resposta do Servidor</title>
</head>
<body>
    <a href="../../index.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
</svg></a>
</body>
</html>
<?php

include_once "./MysqlConection.php";
include_once "../requests/SentMessage.php";

class SentMessageDao
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

            $sentMessage = new sentMessage();
            $result = $sentMessage->sent_messages($bot_key, $start_date, $end_date);

            $response = json_decode($result, true);
            $items = $response['resource']['items'];

            $inserted = 0;
            foreach ($items as $item) {
                if ($this->insertSentMessage($bot_key, $item)) {
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

    private function checkExistingRecord($botKey, $startDate, $endDate)
    {
        $sql = "SELECT COUNT(*) FROM sentMessage WHERE botKey = ? AND start_date = ? AND end_date = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$botKey, $startDate, $endDate]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    private function insertSentMessage($botKey, $item)
    {
        if (isset($item['intervalStart']) && isset($item['intervalEnd']) && isset($item['count'])) {
            $startDate = date('Y-m-d H:i:s', strtotime($item['intervalStart']));
            $endDate = date('Y-m-d H:i:s', strtotime($item['intervalEnd']));

            if (!$this->checkExistingRecord($botKey, $startDate, $endDate)) {
                $sql = "INSERT INTO sentMessage (botKey, start_date, end_date, count) VALUES (?, ?, ?, ?)";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$botKey, $startDate, $endDate, $item['count']]);
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

}

$sentMessageDao = new SentMessageDao();
$sentMessageDao->insert();
?>
