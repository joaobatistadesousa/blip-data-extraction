<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;

class EventDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

    $idBot = $request->idBot;
    $bot_key = $request->bot_key;
    $event_name = $request->category;

    $event = new EventDetailsRequest();
    $datas = $event->calcularDatas();
    $results = $event->EventDetails($bot_key, $datas['start_date'], $datas['end_date'], 10, $event_name);
    // dd($results,
    // $request->all());
    // Verifica se $results é um objeto stdClass e converte para array se necessário
    if (is_string($results)) {
        $results = json_decode($results, true);
    }

    $insertedCount = 0; // Contador para registros inseridos
    $duplicateCount = 0; // Contador para duplicatas encontradas

    foreach ($results as $item) {
        $storageDate = date('Y-m-d H:i:s', strtotime($item->storageDate));

        $category = $item->category;
        $action = $item->action;
        $count = $item->count;

        // Verifica se já existe um registro com os mesmos valores
        $existingRecord = EventDetails::where('storageDate', $storageDate)
            ->where('category', $category)
            ->where('action', $action)
            ->where('count', $count)
            ->where('idSmartContact', $idBot)
            ->first();

        if (!$existingRecord) {
            // Não existe um registro com os mesmos valores, então insira
            EventDetails::create([
                'idSmartContact' => $idBot,
                'category' => $category,
                'action' => $action,
                'storageDate' => $storageDate,
                'count' => $count
            ]);
            $insertedCount++;
        } else {
            $duplicateCount++;
        }
    }

    if ($insertedCount > 0) {
        return redirect()->back()->with('success', "{$insertedCount} dados inseridos com sucesso!");
    } else {
        return redirect()->back()->withErrors(['error' => "{$duplicateCount} registros duplicados encontrados, nenhum novo dado foi inserido."]);
    }

}





    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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

    public function codificarSeNecessario($string)
    {
        $stringCodificada = urlencode($string);
        if ($string !== $stringCodificada) {
            return $stringCodificada;
        } else {
            return $string;
        }
    }

    public function checkEventName($event_name)
    {
        if (preg_match('/[áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/u', $event_name)) {
            $event_name = preg_replace_callback('/[áàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ]/u', function ($matches) {
                return urlencode($matches[0]);
            }, $event_name);
        }

        if (strpos($event_name, ' ') !== false) {
            $parts = explode(' ', $event_name);
            $encodedParts = array_map([$this, 'codificarSeNecessario'], $parts);
            $event_name = implode('%20', $encodedParts);
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
        curl_setopt($ch, CURLOPT_CAINFO, 'C:/laragon/etc/ssl/cacert.pem');

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
}

