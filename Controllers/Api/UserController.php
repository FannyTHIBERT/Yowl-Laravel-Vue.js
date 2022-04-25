<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // La validation de données
    $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'nickname' => ['required', 'string', 'max:255', 'unique:users'],
        'avatar' => ['nullable'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed'],
    ]);

    // On crée un nouvel utilisateur
    $users = User::create([
        'name' => $request->name,
        'nickname' => $request->nickname,
        'avatar' => $request->avatar,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    
    return response()->json($users, 201);
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::find($id); 
        // On retourne les informations de l'utilisateur en JSON
        return  response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, User $users)
    {

    // La validation de données
    $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'nickname' => ['required', 'string', 'max:255', 'unique:users'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'min:8'],
        'password_confirmation' => ['required', 'same:password'],
    ]);
        // On modifie les informations de l'utilisateur
    $user = User::find($id);
    //dd($id);
    $user->name = $request->name;
    $user->nickname = $request->nickname;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);

    $user->save();

    // On retourne la réponse JSON
    return response()->json($user);
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $users, $id)
    {
    $user = User::find($id);
    // On supprime l'utilisateur
    $user->delete();

    // On retourne la réponse JSON
    return response()->json([
        'success' => "User supprimé"
    ]);
    }
}

