<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\PostResource;
use App\Models\Categories; // ajouté par JC , à valider
use Illuminate\Support\Facades\Auth; // ajouté par JC , à valider


class PostController extends Controller
{  

    /*public function __construct()
    {
        $this->middleware('auth');

    }*/
    public function index()
    {
        $posts = Post::all();
       
        return response()->json($posts)
        //->with('categories',Categories::where('parent_id', 1)->with(['children'])->get())   à réécrire selon les items
        ;
    }

    public function store(Request $request)
    {
    // La validation de données
    $this->validate($request, [
        'title' => ['required', 'string', 'max:255'],
        'user_id' => ['nullable', 'string'],
        'category_id' => ['nullable', 'string'],
        'content' => ['required', 'string', 'max:255'],
        'img_post' => ['nullable']
    ]);
    //$userid= Auth::user();
    // On crée un nouveau post
    $posts = Post::create([
        'title' => $request->title,
        'user_id' => $request->user_id,
        'category_id' => $request->category_id,
        'content' => $request->content,
        'img_post' => $request->img_post,
    ]);
    
    return response()->json($posts, 201);
}

    public function show($id)
    {
        $post = Post::find($id);
        return  response()->json($post);
    }


    public function update(Request $request, $id, Post $posts)
{
    // La validation de données
    $this->validate($request, [
        'title' => ['required', 'string', 'max:255'],
        'user_id' => ['nullable', 'string'],
        'category_id' => ['nullable', 'string'],
        'content' => ['required', 'string', 'max:255']
    ]);
    $post = Post::find($id);

    // On modifie les informations du post
    $post->title = $request->title;
    $post->user_id = $request->user_id;
    $post->category_id = $request->category_id;
    $post->content = $request->content;
  
    $post->save();
    // On retourne la réponse JSON
    return response()->json($post);

}

    public function destroy(Post $posts, $id)
    {
        // On supprime l'utilisateur
        $post = Post::find($id);
        $post->delete();

        // On retourne la réponse JSON
        return response()->json([
            'success' => "Post supprimé"
        ]);
    }
    
    public function list($id)
    {
        $categories = Category::all();
        $posts = Post::where('id', $id)->orderBy('updated_at', 'asc')
            ->take(500)
            ->get();
        
        return view('posts', compact('posts', 'categories'));
    }



}
