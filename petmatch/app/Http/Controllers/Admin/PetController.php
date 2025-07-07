<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Usuario;
use App\Http\Requests\StorePetRequest;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = Pet::with('usuario')->paginate(15);
        return view('admin.pets.index', compact('pets'));
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
    public function store(StorePetRequest $request)
    {
        Pet::create($request->validated());

        return redirect()->route('admin.pets.index')->with('success', 'Pet criado com sucesso!');
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
        $pet = Pet::findOrFail($id);
        $usuarios = Usuario::all();
        return view('admin.pets.edit', compact('pet', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePetRequest $request, string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->update($request->validated());

        return redirect()->route('admin.pets.index')->with('success', 'Pet atualizado com sucesso!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.pets.index')->with('success', 'Pet excluído com sucesso!');
    }
}
