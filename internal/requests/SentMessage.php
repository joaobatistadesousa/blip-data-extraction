<?php

include_once ('Request.php');
include_once ('../../core/metrics/SentMessageInterface.php');
class sentMessage implements SentMessageInterface {
    public function sent_messages($bot_key, $start_date, $end_date){
        $url = "https://msging.net/commands";
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $bot_key
        ];
        $body = json_encode([
            "id" => uniqid(),
            "to" => "postmaster@analytics.msging.net",
            "method" => "get",
            "uri" => "/metrics/sent-messages/D?startDate={$start_date}&endDate={$end_date}"
        ]);
        $request=new Request();
        return $request->post($url, $headers, $body);
        
    }
}
