<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Pet;
use App\Models\PetMatch;
use App\Models\Evento;
use App\Models\Mensagem;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function dashboard()
    {
        // Totais básicos
        $totalUsuarios = Usuario::count();
        $totalPets = Pet::count();
        $totalMatches = Petmatch::count();
        $eventosCriados = Evento::count();

        // Usuários ativos últimas 24h
        $usuariosAtivos = Usuario::where('updated_at', '>=', now()->subDay())->count();

        // Distribuição por espécie
        $distribuicaoEspecies = Pet::select('especie', DB::raw('count(*) as total'))
            ->groupBy('especie')
            ->orderBy('total', 'desc')
            ->get();

        // Raças mais populares (Top 5)
        $racasPopulares = Pet::select('raca', DB::raw('count(*) as total'))
            ->groupBy('raca')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // Crescimento semanal de usuários e pets (últimas 5 semanas para teste)
        $crescimentoUsuarios = Usuario::select(
            DB::raw("WEEK(created_at) as semana"),
            DB::raw("YEAR(created_at) as ano"),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subWeeks(5))
            ->groupBy('ano', 'semana')
            ->orderBy('ano')
            ->orderBy('semana')
            ->get();

        $crescimentoPets = Pet::select(
            DB::raw("WEEK(created_at) as semana"),
            DB::raw("YEAR(created_at) as ano"),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subWeeks(5))
            ->groupBy('ano', 'semana')
            ->orderBy('ano')
            ->orderBy('semana')
            ->get();

        // Atividade de Matches e Conversas por semana (últimas 5 semanas para teste)
        $atividadeMatches = Petmatch::select(
            DB::raw("WEEK(created_at) as semana"),
            DB::raw("YEAR(created_at) as ano"),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subWeeks(5))
            ->groupBy('ano', 'semana')
            ->orderBy('ano')
            ->orderBy('semana')
            ->get();

        $atividadeConversas = Mensagem::select(
            DB::raw("WEEK(created_at) as semana"),
            DB::raw("YEAR(created_at) as ano"),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subWeeks(5))
            ->groupBy('ano', 'semana')
            ->orderBy('ano')
            ->orderBy('semana')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsuarios',
            'totalPets',
            'totalMatches',
            'eventosCriados',
            'usuariosAtivos',
            'distribuicaoEspecies',
            'racasPopulares',
            'crescimentoUsuarios',
            'crescimentoPets',
            'atividadeMatches',
            'atividadeConversas'
        ));
    }
    public function index()
    {
        //
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
