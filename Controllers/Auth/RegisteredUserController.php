<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    // La validation de données
    $this->validate($request, [
        'name' => ['required', 'string', 'max:255'],
        'nickname' => ['required', 'string', 'max:255', 'unique:users'],
        'avatar' => ['nullable', 'string'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // On crée un nouvel utilisateur
    $user = User::create([
        'name' => $request->name,
        'nickname' => $request->nickname,
        'avatar' => $request->avatar,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
    event(new Registered($user));

    Auth::login($user);
    // On retourne les informations du nouvel utilisateur en JSON
    return response()->json($user, 201);
}

}
