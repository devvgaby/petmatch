<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Busca as postagens dos pets do tutor autenticado
        // Primeiro pegar os pets do usuário
        $petsIds = Pet::where('usuario_id', Auth::id())->pluck('id');

        // Buscar postagens desses pets
        $postagens = Postagem::whereIn('pet_id', $petsIds)->get();

        return view('tutor.postagens.index', compact('postagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Buscar pets do tutor para escolher ao criar postagem
        $pets = Pet::where('usuario_id', Auth::id())->get();

        return view('tutor.postagens.create', compact('pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'descricao' => 'required|string|max:1000',
            'url_midia' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240', // max 10MB
            'pet_id' => 'required|exists:pets,id',
        ]);

        $midiaPath = null;
        $tipoMidia = null;

        if ($request->hasFile('url_midia') && $request->file('url_midia')->isValid()) {
            $extensao = $request->file('url_midia')->extension();

            if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                $tipoMidia = 'imagem';
            } elseif (in_array($extensao, ['mp4', 'mov', 'avi'])) {
                $tipoMidia = 'video';
            } else {
                return back()->withErrors(['url_midia' => 'Formato de mídia não suportado'])->withInput();
            }

            $midiaPath = $request->file('url_midia')->store('postagens/midias', 'public');
        }

        Postagem::create([
            'descricao' => $validated['descricao'],
            'tipo_midia' => $tipoMidia,
            'url_midia' => $midiaPath,
            'pet_id' => $validated['pet_id'],
        ]);

        return redirect()->route('tutor.postagens.index')->with('success', 'Postagem criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $postagem = Postagem::with(['comentarios.usuario', 'pet'])->findOrFail($id);

        return view('tutor.postagens.show', compact('postagem'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $postagem = Postagem::findOrFail($id);

        // Buscar pets do tutor para escolher no select
        $pets = Pet::where('usuario_id', Auth::id())->get();

        return view('tutor.postagens.edit', compact('postagem', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $postagem = Postagem::findOrFail($id);

        $validated = $request->validate([
            'descricao' => 'required|string|max:1000',
            'url_midia' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:10240',
            'pet_id' => 'required|exists:pets,id',
        ]);

        // Atualizar mídia se existir arquivo enviado
        if ($request->hasFile('url_midia') && $request->file('url_midia')->isValid()) {
            // Apaga mídia antiga
            if ($postagem->url_midia) {
                Storage::disk('public')->delete($postagem->url_midia);
            }

            $extensao = $request->file('url_midia')->extension();

            if (in_array($extensao, ['jpg', 'jpeg', 'png', 'gif'])) {
                $tipoMidia = 'imagem';
            } elseif (in_array($extensao, ['mp4', 'mov', 'avi'])) {
                $tipoMidia = 'video';
            } else {
                return back()->withErrors(['url_midia' => 'Formato de mídia não suportado'])->withInput();
            }

            $midiaPath = $request->file('url_midia')->store('postagens/midias', 'public');

            $postagem->url_midia = $midiaPath;
            $postagem->tipo_midia = $tipoMidia;
        }

        $postagem->descricao = $validated['descricao'];
        $postagem->pet_id = $validated['pet_id'];

        $postagem->save();

        return redirect()->route('tutor.postagens.index')->with('success', 'Postagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $postagem = Postagem::findOrFail($id);

        if ($postagem->url_midia) {
            Storage::disk('public')->delete($postagem->url_midia);
        }

        $postagem->delete();

        return redirect()->route('tutor.postagens.index')->with('success', 'Postagem excluída com sucesso!');
    }
}
