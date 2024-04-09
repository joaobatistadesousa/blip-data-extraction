<?php
include_once "../../internal/requests/Request.php";
include_once "../database/SmartContactDao.php";
include_once "../utilities/retoneDates.php";
include_once "../utilities/SpaceRemoves.php";

class EventTrack {
    public function sendEventTrack() {
        $retoneDates = calcularDatas();
        $start_date = $retoneDates['start_date'];
        $end_date = $retoneDates['end_date'];

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
                "uri" => "/event-track/"
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

    public function sendRequestWithResults($results) {
        $categoryRequests = [];

        foreach ($results as $result) {
            $categories = json_decode($result['result'], true)['resource']['items'];

            foreach ($categories as $category) {
                $categoryName = $category['category'];
                $categoryName = checkEventName($categoryName); // Usando a função para verificar e substituir espaços

                $url = "https://msging.net/commands";
                $headers = [
                    'Content-Type: application/json',
                    'Authorization: ' . $bot_key
                ];
                $body = json_encode([
                    "id" => uniqid(),
                    "to" => "postmaster@analytics.msging.net",
                    "method" => "get",
                    "uri" => "/event-track/{$categoryName}?startDate={$start_date}&endDate={$end_date}&\$take=10"
                ]);

                $categoryRequests[] = [
                    'category' => $categoryName,
                    'request' => ['url' => $url, 'headers' => $headers, 'body' => $body]
                ];
            }
        }

        return $categoryRequests;
    }
}

// Uso
$eventTrack = new EventTrack();
$results = $eventTrack->sendEventTrack();
$categoryRequests = $eventTrack->sendRequestWithResults($results);

echo json_encode($categoryRequests);
