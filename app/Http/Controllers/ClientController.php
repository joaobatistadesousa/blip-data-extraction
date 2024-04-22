<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client2=Client::where('customerName', $request->ClientName)->first();
        if($client2){
            return redirect()->back()->withErrors(['error' => "Nao foi possivel cadastrar, verifique os dados e tente novamente"]);
        }
            $client=Client::create([
                'customerName'=>$request->ClientName,
                'planName'=>$request->planClient
            ]);
            $client->save();
            if($client){
                return redirect()->back()->with(['success' => "Cliente criado com sucesso"]);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
    public function showAll()
    {
        $clients=Client::all();
        return $clients;
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
