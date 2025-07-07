<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Http\Requests\StoreEventoRequest;
use Illuminate\Support\Facades\Http;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $eventos = Evento::orderBy('data_hora', 'asc')->paginate(15);
        return view('admin.eventos.index', compact('eventos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.eventos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventoRequest $request)
    {
        Evento::create($request->validated());

        return redirect()->route('admin.eventos.index')->with('success', 'Evento criado com sucesso!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evento = Evento::findOrFail($id);
        return view('admin.eventos.edit', compact('evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventoRequest $request, string $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->update($request->validated());

        return redirect()->route('admin.eventos.index')->with('success', 'Evento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();

        return redirect()->route('admin.eventos.index')->with('success', 'Evento excluído com sucesso!');
    }

      // Validação de CEP
    public function validarCep($cep)
    {
        $cep = preg_replace('/\D/', '', $cep);

        if (strlen($cep) !== 8) {
            return response()->json(['erro' => 'CEP deve ter 8 dígitos'], 422);
        }

        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->successful()) {
            $data = $response->json();
            if (isset($data['erro'])) {
                return response()->json(['erro' => 'CEP não encontrado'], 404);
            }

            $logradouro = $data['logradouro'] ?? '';
            $bairro = $data['bairro'] ?? '';
            $cidade = $data['localidade'] ?? '';
            $estado = $data['uf'] ?? '';

            $enderecoCompleto = trim("{$logradouro}, {$bairro}, {$cidade} - {$estado}");

            return response()->json([
                'cep' => $data['cep'],
                'logradouro' => $logradouro,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'estado' => $estado,
                'enderecoCompleto' => $enderecoCompleto,
            ]);
        }

        return response()->json(['erro' => 'Serviço ViaCEP temporariamente indisponível'], 503);
    }

    // Obter geolocalização (latitude e longitude)
    public function obterGeolocalizacao(Request $request)
    {
        $endereco = $request->input('endereco');

        if (!$endereco) {
            return response()->json(['erro' => 'Endereço é obrigatório'], 422);
        }

        $url = "https://nominatim.openstreetmap.org/search";
        $response = Http::get($url, [
            'q' => $endereco,
            'format' => 'json',
            'limit' => 1,
            'addressdetails' => 1,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (empty($data)) {
                return response()->json(['erro' => 'Endereço não encontrado na base geográfica'], 404);
            }

            return response()->json([
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon'],
            ]);
        }

        return response()->json(['erro' => 'Serviço de geolocalização indisponível'], 503);
    }
}

