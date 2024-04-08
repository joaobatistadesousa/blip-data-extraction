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
