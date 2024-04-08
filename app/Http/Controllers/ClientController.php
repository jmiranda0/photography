<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('id')->get();

        return response()->json($clients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        try{
            request()->validate(Client::$rules);
            $client = Client::create($request->all());
            return response()->json([$client,'message'=>"success, Client created successfully."]);
        }catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] === 1062) {
                
                $client= Client::where('email',$request->email)->first();
                return response()->json(['client'=>$client,'message' => 'Error creating client. The email provided already exists.'], 400);
            }
        }catch(\Exception $e){
            return response()->json(['message' => 'Error creating client.', 'errors' => $e->errors()], 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        return view('client.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        if (!$client){
            return response()->json(['message' => 'Client no encontrado'], 404);
        }
        return response()->json($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Client $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        request()->validate(Client::$rules);

        $client->update($request->all());

        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully');
    }

    /**
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
