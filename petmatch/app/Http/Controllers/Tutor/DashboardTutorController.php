<?php

namespace App\Http\Controllers\Tutor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Postagem;
use App\Models\Evento;
use App\Models\PetMatch;

class DashboardTutorController extends Controller
{
    /**
     * Display a listing of the resource.
     */

  public function dashboard()
    {
        $usuarioId = auth()->id();

        $totalPets = Pet::where('usuario_id', $usuarioId)->count();

        $totalPostagens = Postagem::whereHas('pet', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->count();

        $totalEventos = Evento::where('usuario_id', $usuarioId)->count();

        $totalMatches = PetMatch::whereHas('pet1', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->orWhereHas('pet2', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->count();

        return view('tutor.dashboard', compact(
            'totalPets', 'totalPostagens', 'totalEventos', 'totalMatches'
        ));
    }

    public function index()
    {

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
    public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
