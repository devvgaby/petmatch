<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create()
    {
        return view('auth.register'); // Sua view de registro
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(StoreUsuarioRequest $request): RedirectResponse
    {
        $data = $request->validated();

        dd('CHEGOU AQUI', $request->all());
        $data['perfil_id'] = 2;

        $data['password'] = Hash::make($data['password']);

        $user = Usuario::create($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('tutor.dashboard')->with('success', 'Cadastro realizado com sucesso!');
    }
}
