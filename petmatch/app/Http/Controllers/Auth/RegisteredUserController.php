<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUsuarioRequest;
use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(StoreUsuarioRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['perfil_id'] = 2;
        $data['password'] = Hash::make($data['password']);

        $usuario = Usuario::create($data);

        event(new Registered($usuario));
        Auth::login($usuario);

        return redirect()->route('tutor.dashboard')->with('success', 'Cadastro realizado com sucesso!');
    }

    public function validarCep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return response()->json(['erro' => 'CEP deve conter 8 dígitos'], 422);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");
        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['erro'])) {
                return response()->json(['erro' => 'CEP não encontrado'], 404);
            }

            $enderecoCompleto = "{$data['logradouro']}, {$data['bairro']}, {$data['localidade']} - {$data['uf']}";

            return response()->json([
                'cep' => $data['cep'],
                'logradouro' => $data['logradouro'],
                'bairro' => $data['bairro'],
                'cidade' => $data['localidade'],
                'estado' => $data['uf'],
                'enderecoCompleto' => $enderecoCompleto,
            ]);
        }

        return response()->json(['erro' => 'Serviço ViaCEP temporariamente indisponível'], 503);
    }

    public function obterGeolocalizacao(Request $request)
    {
        $endereco = $request->input('endereco');

        if (!$endereco) {
            return response()->json(['erro' => 'Endereço é obrigatório'], 422);
        }

        $response = Http::get("https://nominatim.openstreetmap.org/search", [
            'q' => $endereco,
            'format' => 'json',
            'limit' => 1
        ]);

        if ($response->successful() && !empty($response->json())) {
            $data = $response->json();
            return response()->json([
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon']
            ]);
        }

        return response()->json(['erro' => 'Não foi possível obter coordenadas'], 404);
    }
}
