<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::where('usuario_id', Auth::id())->get();
        return view('tutor.pets.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tutor.pets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raca' => 'nullable|string|max:100',
            'idade' => 'required|integer|min:0',
            'sexo' => 'required|in:macho,femea',
            'descricao' => 'nullable|string',
            'preferencias' => 'nullable|string',
            'foto_perfil' => 'nullable|image|max:2048', // max 2MB
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
            // Salva a foto no storage/app/public/pets/fotos
            $fotoPath = $request->file('foto_perfil')->store('pets/fotos', 'public');
        }

        Pet::create([
            'nome' => $validated['nome'],
            'especie' => $validated['especie'],
            'raca' => $validated['raca'] ?? null,
            'idade' => $validated['idade'],
            'sexo' => $validated['sexo'],
            'descricao' => $validated['descricao'] ?? null,
            'preferencias' => $validated['preferencias'] ?? null,
            'foto_perfil_url' => $fotoPath,
            'usuario_id' => Auth::id(),
        ]);

        return redirect()->route('tutor.pets.index')->with('success', 'Pet cadastrado com sucesso!');
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
        $pet = Pet::where('usuario_id', Auth::id())->findOrFail($id);

        return view('tutor.pets.edit', compact('pet'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pet = Pet::where('usuario_id', Auth::id())->findOrFail($id);

        // Validação (igual ao store)
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'especie' => 'required|string|max:50',
            'raca' => 'nullable|string|max:100',
            'idade' => 'required|integer|min:0',
            'sexo' => 'required|in:macho,femea',
            'descricao' => 'nullable|string',
            'preferencias' => 'nullable|string',
            'foto_perfil' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto_perfil') && $request->file('foto_perfil')->isValid()) {
            if ($pet->foto_perfil_url) {
                Storage::disk('public')->delete($pet->foto_perfil_url);
            }
            $fotoPath = $request->file('foto_perfil')->store('pets/fotos', 'public');
            $pet->foto_perfil_url = $fotoPath;
        }

        $pet->nome = $validated['nome'];
        $pet->especie = $validated['especie'];
        $pet->raca = $validated['raca'] ?? null;
        $pet->idade = $validated['idade'];
        $pet->sexo = $validated['sexo'];
        $pet->descricao = $validated['descricao'] ?? null;
        $pet->preferencias = $validated['preferencias'] ?? null;

        $pet->save();

        return redirect()->route('tutor.pets.index')->with('success', 'Pet atualizado com sucesso!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
