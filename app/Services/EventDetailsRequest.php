<?php
namespace App\Services;

class EventDetailsRequest
{
    public function calcularDatas()
    {
        // Obter a data atual
        $endDate = date('Y-m-d');

        // Subtrair 30 dias da data atual para obter a start_date
        $startDate = date('Y-m-d', strtotime('-30 days', strtotime($endDate)));

        return array('start_date' => $startDate, 'end_date' => $endDate);
    }



    function checkEventName($event_name)
    {
        // Verifica se a string contém caracteres especiais
        if (preg_match('/[^\w\s\d]/u', $event_name)) {
            $event_name = urlencode($event_name);

        }
        else{
         $event_name = urlencode($event_name);
        }
        return $event_name;


    }
    public function EventDetails($bot_key, $start_date, $end_date, $quantity_of_events, $event_name)
    {
        $event_name = $this->checkEventName($event_name);
        $url = "https://msging.net/commands";
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $bot_key
        ];

        $body = json_encode([
            "id" => uniqid(),
            "to" => "postmaster@analytics.msging.net",
            "method" => "get",
            "uri" => "/event-track/{$event_name}?startDate={$start_date}&endDate={$end_date}&\$take={$quantity_of_events}"
        ]);

        // Use a função post que você criou
        $response = $this->post($url, $headers, $body);
        $response = json_decode($response);

        return $response->resource->items;
    }

    public function post($uri, $headers, $body)
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_CAINFO, 'C:/laragon/etc/ssl/cacert.pem');

        // Adicione estes logs para debugar
        try {
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                throw new Exception('Erro na requisição: ' . curl_error($ch));
            }
            return $response;
        } catch (Exception $e) {
            throw new Exception('Erro na requisição: ' . $e->getMessage());
        } finally {
            curl_close($ch);
        }
    }
    public function getEspecificsEvents($boots, $eventsNames)
    {
        $datas = $this->calcularDatas();
        $allEventsData = [];

        foreach ($boots as $bot_key) {
            foreach ($eventsNames as $event_name) {
                $eventData = $this->EventDetails($bot_key, $datas['start_date'], $datas['end_date'], 100, $event_name);
                $allEventsData = array_merge($allEventsData, $eventData);
            }
        }
        return $allEventsData;
    }

    
}

