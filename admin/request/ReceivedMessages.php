<?php
include_once "../../internal/requests/Request.php";
include_once "../database/SmartContactDao.php";
include_once "../utilities/retoneDates.php";
include_once "../utilities/SpaceRemoves.php";

class SentMessage {
    public function ReceivedToAllSmartContacts() {
        $retoneDates = calcularDatas();
        
        $startDate = $retoneDates['start_date']; // Corrigido para 'start_date'
        $endDate = $retoneDates['end_date']; // Corrigido para 'end_date'

        $smartContactDao = new SmartContactDao();
        $smartContacts = $smartContactDao->findMany();
        $results = [];

        foreach ($smartContacts as $smartContact) {
            $bot_key = $smartContact['botKey'];
            $url = "https://msging.net/commands";
            $headers = [
                'Content-Type: application/json',
                'Authorization: ' . $bot_key
            ];
            $body = json_encode([
                "id" => uniqid(),
                "to" => "postmaster@analytics.msging.net",
                "method" => "get",
                "uri" => "/metrics/received-messages/D?startDate={$startDate}&endDate={$endDate}"
            ]);

            $request = new Request();
            $result = $request->post($url, $headers, $body);

            $results[] = [
                'smartContact' => $smartContact,
                'result' => $result
            ];
        }

        return $results;
    }
}

// Uso
$sentMessage = new SentMessage();
$results = $sentMessage->ReceivedToAllSmartContacts();
echo json_encode($results);

