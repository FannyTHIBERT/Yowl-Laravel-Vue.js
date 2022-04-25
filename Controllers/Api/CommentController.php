<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;


class CommentController extends Controller
{
    public function index(){
        $comments = Comment::all();
        return response()->json($comments);
    }

    public function store(Request $request){
        $this->validate($request, [
            'comment' => ['required', 'string', 'max:255'],
            'user_id' => ['nullable', 'integer'],
            'post_id' => ['nullable', 'integer'],
            
        ]);
    
        // On crée un nouveau post
        $comments = Comment::create([
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'post_id' => $request->post_id,
            
        ]);
        
        return response()->json($comments, 201);
    }

    public function show($id){
        
        $comment = Comment::where('post_id', '=', $id)->get();
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comments){
        if ($comment->update($request->all())){
            return response()->json([
                'success' => "commentaire modifié"
            ]);
        };
    }

    public function destroy(Comment $comments, $id){
        $comment = Comment::find($id);
        //dd($id);
        if ($comment->delete()){
            return response()->json([
                'success' => "commentaire supprimé"
            ]);
        };
    }
}