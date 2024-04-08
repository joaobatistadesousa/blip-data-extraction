<?php
include_once ('Request.php');
include_once ('../../core/metrics/EventDetailsInterface.php');

class EventDetails implements EventDetailsInterface{
     function checkEventName($event_name){
            if (strpos($event_name, ' ') !== false) {
                $event_name = str_replace(' ', '%20', $event_name);
            }
            return $event_name;
        }
        
        public function EventDetails($bot_key, $start_date, $end_date,$quantity_of_events,$event_name){
           $event_name = $this->checkEventName($event_name); // Corrigido para $this->checkEventName
        $url="https://msging.net/commands";
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $bot_key
        ];
        
        $body=json_encode([
            "id" => uniqid(),
            "to" => "postmaster@analytics.msging.net",
            "method" => "get",
            "uri" => "/event-track/{$event_name}?startDate={$start_date}&endDate={$end_date}&\$take={$quantity_of_events}"

        ]);
        $request=new Request();
        return $request->post($url, $headers, $body);

    }

}
?>
