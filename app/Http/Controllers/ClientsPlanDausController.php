<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientsPlanDaus;
use App\Services\ClientPlanDausC; // Atualize o namespace

class ClientsPlanDausController extends Controller
{
    public function store()
    {
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
