<?php

namespace App\Http\Controllers;

use App\Models\ClientsAgenda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;

/**
 * Class ClientsAgendaController
 * @package App\Http\Controllers
 */
class ClientsAgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientsAgendas = ClientsAgenda::orderBy('id')->get();

        return response()->json($clientsAgendas);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $clientController = new ClientController();
        $agendaController = new AgendaController();
        
        // Crear el client
        $client = $clientController->store($request);
        if($client->original['message'] != "success, Client created successfully.")
            if($client->original['message'] != 'Error creating client. The email provided already exists.')
                return response()->json($client->original);
        $agenda = $agendaController->store($request);
        if($agenda->original['message']!= "success, Agenda created successfully.")
                return response()->json($agenda->original);
          //$client->original['client']  
        $ca = new ClientsAgenda;
        $ca->clients_id = $client->original['client']->id;
        $ca->agendas_id = $agenda->original['agenda']->id;
        $ca->save();
        return response()->json(['message'=>"success, The client has a date successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clientsAgenda = ClientsAgenda::find($id);

        if (!$clientsAgenda){
            return response()->json(['message' => 'ClientsAgenda no encontrado'], 404);
        }
        return response()->json($clientsAgenda);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  ClientsAgenda $clientsAgenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientsAgenda $clientsAgenda)
    {
        request()->validate(ClientsAgenda::$rules);

        $clientsAgenda->update($request->all());

        return redirect()->route('clients-agendas.index')
            ->with('success', 'ClientsAgenda updated successfully');
    }

    /**
     * @param ClientsAgenda $clientsAgenda
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(ClientsAgenda $clientsAgenda)
    {
        $clientsAgenda->delete();

        return redirect()->route('clients-agendas.index')
            ->with('success', 'ClientsAgenda deleted successfully');
    }
}
