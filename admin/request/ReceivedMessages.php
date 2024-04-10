<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css//index.css">
    <title>Resposta do Servidor receviedMessage</title>
</head>
<body>
    <a href="../index.php">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
</svg></a>
</body>
</html>

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

