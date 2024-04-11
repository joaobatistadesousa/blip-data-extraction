<?php
include_once "./MysqlConection.php";
include_once "../request/ReceivedMessages.php";

class ReceivedMessagesDao
{
    private $connection;

    public function __construct()
    {
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }

    public function checkDuplicate($startDate, $endDate, $smartContactId, $count)
    {
        $sql = "SELECT COUNT(*) FROM received_messages WHERE start_date = ? AND end_date = ? AND idSmartContact = ? AND count = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$startDate, $endDate, $smartContactId, $count]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function insert()
    {
        $data = new SentMessage(); // Ajuste conforme necessário para obter os dados corretos
        $data = $data->ReceivedToAllSmartContacts();
        foreach ($data as $item) {
            $smartContactId = $item['smartContact']['id'];
            $results = json_decode($item['result'], true);

            foreach ($results['resource']['items'] as $resultItem) {
                $startDate = $resultItem['intervalStart'];
                $endDate = $resultItem['intervalEnd'];
                $count = $resultItem['count'];

                if (!$this->checkDuplicate($startDate, $endDate, $smartContactId, $count)) {
                    $queryInsert = "INSERT INTO received_messages (idSmartContact, start_date, end_date, count) 
                          VALUES (?, ?, ?, ?)";
                    $statementInsert = $this->connection->prepare($queryInsert);
                    $statementInsert->execute([$smartContactId, date('Y-m-d H:i:s', strtotime($startDate)), date('Y-m-d H:i:s', strtotime($endDate)), $count]);
                } 
            }
        }
    }
}

$receivedMessagesDao = new ReceivedMessagesDao();
$receivedMessagesDao->insert();

?>
