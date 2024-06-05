<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SmartContact;
use Illuminate\Http\Request;
use App\Models\Client;

class SmartContactController extends Controller
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
        $smart = SmartContact::where('botKey', $request->bot_key)->first();
        if($smart){
            return redirect()->back()->withErrors(['error' => "Nao foi possivel cadastrar, verifique os dados e tente novamente"]);
        }
        $smartContact= SmartContact::create([
            'botKey' => $request->bot_key,
            'name' => $request->bot_name,
            'clientId' => $request->client_id
        ]);
        if($smartContact){
            return redirect()->back()->with(['success' => "Bot criado com sucesso"]);
        }


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
    public function getAllClientsOfPlanNames()
    {
        // Supondo que você tenha um modelo Client que mapeia para a tabela client
        $clients = Client::whereIn('planName', [
            'Startup',
            'Lite',
            'Plus',
            'Super'
        ])->get()->pluck('id');
    
        $results = [];
    
        foreach ($clients as $clientId) {
            $smartContacts = SmartContact::where('clientId', $clientId)->get()->toArray();
            $results = array_merge($results, $smartContacts);
        }
    
        return $results;
    }
    
 
    public function getAllClientsExcludingPlanNames()
{
    $clients = Client::whereNotIn('planName', [
        'Startup',
        'Lite',
        'Plus',
        'Super'
    ])->get()->pluck('id');

    

    $results = [];

    foreach ($clients as $clientId) {
        $smartContacts = SmartContact::where('clientId', $clientId)->get()->toArray();
        
        $results = array_merge($results, $smartContacts);
    
    }

    return $results;
}

}