<?php
include_once "./MysqlConection.php";
include_once "../request/SentMessage.php";

class SentMessageDao
{
    private $connection;

    public function __construct()
    {
        $mysqlConnection = new MysqlConection();
        $this->connection = $mysqlConnection->getConnection();
    }

    public function checkDuplicate($startDate, $endDate, $smartContactId, $count)
    {
        $sql = "SELECT COUNT(*) FROM sentMessage WHERE start_date = ? AND end_date = ? AND idSmartContact = ? AND count = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$startDate, $endDate, $smartContactId, $count]);
        $count = $stmt->fetchColumn();
        return $count > 0;
    }

    public function insert()
    {
        $data = new SentMessage();
        $data = $data->sendToAllSmartContacts();
        foreach ($data as $item) {
            $smartContactId = $item['smartContact']['id'];
            $results = json_decode($item['result'], true);

            foreach ($results['resource']['items'] as $resultItem) {
                $startDate = $resultItem['intervalStart'];
                $endDate = $resultItem['intervalEnd'];
                
                $count = $resultItem['count'];

                if (!$this->checkDuplicate($startDate, $endDate, $smartContactId, $count)) {
                    $queryInsert = "INSERT INTO sentMessage (idSmartContact, start_date, end_date, count) 
                          VALUES (?, ?, ?, ?)";
                    $statementInsert = $this->connection->prepare($queryInsert);
                    $statementInsert->execute([$smartContactId, $startDate, $endDate, $count]);
                } 
            }
        }
    }
}

$sentMessageDao = new SentMessageDao();
$sentMessageDao->insert();

?>
