<?php

namespace App\Http\Controllers;

use App\Models\Social;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class SocialController
 * @package App\Http\Controllers
 */
class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials = Social::orderBy('id')->get();

        return response()->json($socials);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Social::$rules);

        Social::create($request->all());

        return redirect()->route('socials.index')
            ->with('success', 'Social created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $social = Social::find($id);

        if (!$social){
            return response()->json(['message' => 'Social no encontrado'], 404);
        }
        return response()->json($social);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Social $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        request()->validate(Social::$rules);

        $social->update($request->all());

        return redirect()->route('socials.index')
            ->with('success', 'Social updated successfully');
    }

    /**
     * @param Social $social
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Social $social)
    {
        $social->delete();

        return redirect()->route('socials.index')
            ->with('success', 'Social deleted successfully');
    }
}
