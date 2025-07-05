<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetMatchRequest;
use App\Models\Pet;
use App\Models\PetMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $usuario = auth()->user();
        $meusPets = $usuario->pets;

        $petsCompativeis = collect();

        if ($request->has('pet_id')) {
            $petSelecionado = Pet::where('id', $request->pet_id)
                ->where('usuario_id', $usuario->id)
                ->firstOrFail();

            $petsCompativeis = Pet::where('especie', $petSelecionado->especie)
                ->whereBetween('idade', [$petSelecionado->idade - 2, $petSelecionado->idade + 2])
                ->where('usuario_id', '!=', $usuario->id)
                ->whereNotIn('id', $meusPets->pluck('id'))
                ->get();
        }

        return view('tutor.matches.index', [
            'meusPets' => $meusPets,
            'petsCompativeis' => $petsCompativeis
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetMatchRequest $request)
    {
        $pet1 = Pet::findOrFail($request->pet1_id);
        $pet2 = Pet::findOrFail($request->pet2_id);

        if ($pet1->usuario_id === $pet2->usuario_id) {
            return back()->with('error', 'Você não pode dar match no próprio pet.');
        }

        $matchExistente = PetMatch::where(function ($q) use ($pet1, $pet2) {
            $q->where('pet1_id', $pet1->id)->where('pet2_id', $pet2->id);
        })->orWhere(function ($q) use ($pet1, $pet2) {
            $q->where('pet1_id', $pet2->id)->where('pet2_id', $pet1->id);
        })->first();

        if ($matchExistente && $matchExistente->pet1_id == $pet2->id && $matchExistente->status == 'pendente') {
            $matchExistente->update(['status' => 'aceito']);
            return back()->with('success', 'Match aceito! Agora vocês podem conversar.');
        }

        PetMatch::create([
            'pet1_id' => $pet1->id,
            'pet2_id' => $pet2->id,
            'status' => 'pendente'
        ]);

        return back()->with('success', 'Interesse registrado! Aguardando o outro tutor.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $usuario = auth()->user();

        $pet1 = Pet::where('id', $request->pet1_id)
            ->where('usuario_id', $usuario->id)
            ->firstOrFail();

        PetMatch::create([
            'pet1_id' => $pet1->id,
            'pet2_id' => $id,
            'status' => 'rejeitado'
        ]);

        return back()->with('info', 'Você descartou esse pet.');
    }
}
