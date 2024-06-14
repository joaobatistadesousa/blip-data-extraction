<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\EventDetails;
use App\Models\SmartContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Services\EventDetailsRequest;


class EventDetailsController extends Controller
{
    
    public function store(Request $request)

{
    $idBot = $request->idBot;
    $bot_key = $request->bot_key;
    $event_name = $request->category;

    $event = new EventDetailsRequest();
    $datas = $event->calcularDatas();
    $results = $event->EventDetails($bot_key, $datas['start_date'], $datas['end_date'], 10, $event_name);

     if($results==[]){
        return redirect()->back()->withErrors(['error' => "Nenhum registro encontrado"]);


     }
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




public function storeEspecific($bot_key, $eventsNames)
{
    // Busca o ID do bot a partir da chave do bot
    $bot = SmartContact::where('botKey', $bot_key)->first();
    if (!$bot) {
        return ['error' => "Bot não encontrado"];
    }
    $bot_id = $bot->id;

    $eventDetailsRequest = new EventDetailsRequest();
    $results = $eventDetailsRequest->getEspecificsEvents([$bot_key], $eventsNames);

    if (empty($results)) {
        return ['error' => "Nenhum registro encontrado"];
    }

    $insertedCount = 0;
    $duplicateCount = 0;

    foreach ($results as $item) {
        $storageDate = date('Y-m-d H:i:s', strtotime($item->storageDate));
        $category = $item->category;
        $action = $item->action;
        $count = $item->count;

        $existingRecord = EventDetails::where('storageDate', $storageDate)
            ->where('category', $category)
            ->where('action', $action)
            ->where('count', $count)
            ->where('idSmartContact', $bot_id)
            ->first();

        if (!$existingRecord) {
            EventDetails::create([
                'idSmartContact' => $bot_id,
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
        return "{$insertedCount} dados inseridos com sucesso!";
    } else {
        return "{$duplicateCount} registros duplicados encontrados, nenhum novo dado foi inserido.";
    }
}
}



    

