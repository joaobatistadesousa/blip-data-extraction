<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SentMessage;
use App\Models\SmartContact;
use Illuminate\Support\Facades\Log;
use Exception;

class SentMessageController extends Controller
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
        $r = new SentMessageC();
        $results = $r->ReceivedToAllSmartContacts();

        foreach ($results['dataUser'] as $userId => $userData) {
            foreach ($userData as $item) {
                $idSmartContact = $userId;
                $startDate = date('Y-m-d H:i:s', strtotime($item['intervalStart']));
                $endDate = date('Y-m-d H:i:s', strtotime($item['intervalEnd']));
                $count = $item['count'];

                // Verifica se já existe um registro com os mesmos valores
                $existingRecord = SentMessage::where('idSmartContact', $idSmartContact)
                    ->where('start_date', $startDate)
                    ->where('end_date', $endDate)
                    ->where('count', $count)
                    ->first();

                if($existingRecord) {
                    // Já existe um registro com esses valores, mande uma mensagem de erro
                    return redirect()->back()->withErrors(['error' => 'Já existe um registro com esses dados, não foi possível inserir']);
                }
                if (!$existingRecord) {
                    // Não existe um registro com os mesmos valores, então insira
                    SentMessage::create([
                        'idSmartContact' => $idSmartContact,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'count' => $count
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Registros inseridos com sucesso');

    }
}

















   /**
    * Display the specified resource.
    */
   class SentMessageC
   {
       public function post($uri, $headers, $body)
       {
           $ch = curl_init($uri);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
           curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_CAINFO, 'C:/laragon/etc/ssl/cacert.pem');

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

       public function calcularDatas()
       {
           // Obter a data atual
           $endDate = date('Y-m-d');

           // Subtrair 30 dias da data atual para obter a start_date
           $startDate = date('Y-m-d', strtotime('-30 days', strtotime($endDate)));

           return array('start_date' => $startDate, 'end_date' => $endDate);
       }
       public function ReceivedToAllSmartContacts()
   {
       $retoneDates = $this->calcularDatas();
       $startDate = $retoneDates['start_date']; // Corrigido para 'start_date'
       $endDate = $retoneDates['end_date']; // Corrigido para 'end_date'

       $smartContacts = SmartContact::all();
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
               "uri" => "/metrics/sent-messages/D?startDate={$startDate}&endDate={$endDate}"
           ]);

           $result = $this->post($url, $headers, $body);
           $data = json_decode($result, true);

           // Adiciona os itens ao array de resultados
           $results['dataUser'][$smartContact['id']] = $data['resource']['items'];
       }

       // Retorna o array completo de resultados
       return $results;
   }

    /**
     * Display the specified resource.
     */
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
