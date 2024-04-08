<?php

namespace App\Http\Controllers;

use App\Models\PostsSocial;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class PostsSocialController
 * @package App\Http\Controllers
 */
class PostsSocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postsSocials = PostsSocial::orderBy('id')->get();

        return response()->json($postsSocials);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(PostsSocial::$rules);

        PostsSocial::create($request->all());

        return redirect()->route('posts-socials.index')
            ->with('success', 'PostsSocial created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $postsSocial = PostsSocial::find($id);
        if (!$postsSocial){
            return response()->json(['message' => 'PostsSocial no encontrado'], 404);
        }
        return response()->json($postsSocial);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  PostsSocial $postsSocial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PostsSocial $postsSocial)
    {
        request()->validate(PostsSocial::$rules);

        $postsSocial->update($request->all());

        return redirect()->route('posts-socials.index')
            ->with('success', 'PostsSocial updated successfully');
    }

    /**
     * @param PostsSocial $postsSocial
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(PostsSocial $postsSocial)
    {
        $postsSocial->delete();

        return redirect()->route('posts-socials.index')
            ->with('success', 'PostsSocial deleted successfully');
    }
}
