<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLikesRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateLikesRequest;
use App\Models\Likes;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $likes = Likes::all();
       
        return response()->json($likes)
        //->with('categories',Categories::where('parent_id', 1)->with(['children'])->get())   à réécrire selon les items
        ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLikesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    // La validation de données
    $this->validate($request, [
        'jaime' => ['required', 'integer'],
        'user_id' => ['nullable', 'integer'],
        'post_id' => ['nullable', 'integer'],
        'comment_id' => ['nullable', 'integer'],
            ]);
    
    // On crée un nouveau post
    $like = Likes::create([
        'jaime' => $request->jaime,
        'user_id' => $request->user_id,
        'post_id' => $request->post_id,
        'comment_id' => $request->comment,
            ]);
    
    return response()->json($like, 201);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function show($idpost){
        
        $likes = Likes::where('post_id', '=', $idpost)->get();
        return response()->json($likes);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function edit(Likes $likes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLikesRequest  $request
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLikesRequest $request, Likes $likes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Likes  $likes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Likes $likes)
    {
        //
    }
}
