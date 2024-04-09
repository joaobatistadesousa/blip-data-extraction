<?php
include_once "../../internal/requests/Request.php";
include_once "../database/SmartContactDao.php";
include_once "../utilities/retoneDates.php";
include_once "../utilities/SpaceRemoves.php";
include_once "../../internal/requests/eventDetails.php";

class CategoryName {
    public $bot_key;
    public $start_date;
    public $end_date;

    public function sendEventTrack() {
        $retoneDates = calcularDatas();
        $this->start_date = $retoneDates['start_date'];
        $this->end_date = $retoneDates['end_date'];

        $smartContactDao = new SmartContactDao();
        $smartContacts = $smartContactDao->findMany();
        $results = [];

        foreach ($smartContacts as $smartContact) {
            if (!is_array($smartContact)) {
                continue;
            }

            $this->bot_key = $smartContact['botKey'];
            $url = "https://msging.net/commands";
            $headers = [
                'Content-Type: application/json',
                'Authorization: ' . $this->bot_key
            ];
            $body = json_encode([
                "id" => uniqid(),
                "to" => "postmaster@analytics.msging.net",
                "method" => "get",
                "uri" => "/event-track/"
            ]);

            $request = new Request();
            $result = $request->post($url, $headers, $body);

            $decodedResult = json_decode($result, true);
            if ($decodedResult && isset($decodedResult['resource']['items'])) {
                $categories = $decodedResult['resource']['items'];
                foreach ($categories as $category) {
                    $categoryName = $category['category'];
                    $results[] = $categoryName;
                }
            }
        }

        return $results;
    }
}