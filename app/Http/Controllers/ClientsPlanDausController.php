<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SmartContactController;

use App\Models\ClientsPlanDaus;

class ClientsPlanDausController  extends Controller
{
    public function store()
    {
        // Supondo que o método daos() retorne os dados que você quer processar
        $daos = new ClientPlanDausC();
        $data = $daos->daos(); // Aqui estou supondo que daos() retorna os dados no formato desejado
    
        $dataUser = $data['dataUser']; // Pegue o array de 'dataUser'
        $duplicatedRecords = [];
    
        foreach ($dataUser as $idSmartContact => $userData) {
            foreach ($userData as $item) {
                $startDate = date('Y-m-d H:i:s', strtotime($item['intervalStart']));
                $endDate = date('Y-m-d H:i:s', strtotime($item['intervalEnd']));
                $count = $item['count'];
    
                // Verifica se já existe um registro com os mesmos valores
                $existingRecord = ClientsPlanDaus::where('idSmartContact', $idSmartContact)
                    ->where('start_date', $startDate)
                    ->where('end_date', $endDate)
                    ->where('count', $count)
                    ->first();
    
                if (!$existingRecord) {
                    // Insere o novo registro se não existir duplicata
                    ClientsPlanDaus::create([
                        'idSmartContact' => $idSmartContact,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'count' => $count,
                        // Adicione outros campos necessários aqui
                    ]);
                } else {
                    // Adiciona aos registros duplicados
                    $duplicatedRecords[] = [
                        'idSmartContact' => $idSmartContact,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'count' => $count,
                    ];
                }
            }
        }
    
    
        return redirect()->back()->with('success', 'Registros inseridos com sucesso');
    }
    

}

class ClientPlanDausC
{
    public function post($uri, $headers, $body)
    {
        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     //    curl_setopt($ch, CURLOPT_CAINFO, 'C:/laragon/etc/ssl/cacert.pem');

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
    public function daos()
{
    $retoneDates = $this->calcularDatas();
    $startDate = $retoneDates['start_date']; // Corrigido para 'start_date'
    $endDate = $retoneDates['end_date']; // Corrigido para 'end_date'

    $smartContacts = new SmartContactController();
    $smartContacts = $smartContacts->getAllClientsOfPlanNames();
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
            "uri" => "metrics/active-identity/D?startDate={$startDate}&endDate={$endDate}"
        ]);

        $result = $this->post($url, $headers, $body);
        $data = json_decode($result, true);

        // Adiciona os itens ao array de resultados
        $results['dataUser'][$smartContact['id']] = $data['resource']['items'];
    }

    // Retorna o array completo de resultados
    return $results;
}
}

