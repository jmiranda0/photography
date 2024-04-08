<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class AgendaController
 * @package App\Http\Controllers
 */
class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendas = Agenda::orderBy('id')->get();

        return response()->json($agendas);
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
        request()->validate(Agenda::$rules);
        }catch(\Exception $e){
            return response()->json(['message' => 'Error creating agenda.', 'errors' => $e->errors()], 400);
        }
        $agendaItems = Agenda::where('date', $request->date)->get();
        if(!$agendaItems->isEmpty()){
            foreach ($agendaItems as $item){
                // echo($item->hour);
                if ($item->hour == $request->hour)
                    return response()->json(['message' => 'Ya existe un elemento con la misma fecha y hora.'], 409);
            }
        }
            $agenda = Agenda::create($request->all());
                    $agenda->state ='pending';
                    $agenda->save();
                    return response()->json(['agenda'=>$agenda,'message'=>"success, Agenda created successfully."]);
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agenda = Agenda::find($id);

        if (!$agenda){
            return response()->json(['message' => 'Agenda no encontrado'], 404);
        }
        return response()->json($agenda);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agenda $agenda)
    {
        request()->validate(Agenda::$rules);

        $agenda->update($request->all());

        return redirect()->route('agendas.index')
            ->with('success', 'Agenda updated successfully');
    }

    /**
     * @param Agenda $agenda
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agendas.index')
            ->with('success', 'Agenda deleted successfully');
    }
}
