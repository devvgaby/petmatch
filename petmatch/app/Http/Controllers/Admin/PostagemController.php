<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Postagem;
use App\Models\Pet;
use App\Http\Requests\StorePostagemRequest;
use Illuminate\Support\Facades\Storage;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $postagens = Postagem::with('pet.usuario')->latest()->paginate(15);
        return view('admin.postagens.index', compact('postagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pets = Pet::with('usuario')->get();
        return view('admin.postagens.create', compact('pets'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostagemRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('arquivo')) {
            $data['url_midia'] = $request->file('arquivo')->store('postagens', 'public');
        }

        Postagem::create($data);

        return redirect()->route('admin.postagens.index')->with('success', 'Postagem criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Opcional: implementar se precisar exibir detalhes específicos
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postagem $postagem)
    {
        $pets = Pet::with('usuario')->get();
        return view('admin.postagens.edit', compact('postagem', 'pets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostagemRequest $request, Postagem $postagem)
    {
        $data = $request->validated();

        if ($request->hasFile('arquivo')) {
            // Remove mídia antiga se existir
            if ($postagem->url_midia && Storage::disk('public')->exists($postagem->url_midia)) {
                Storage::disk('public')->delete($postagem->url_midia);
            }
            $data['url_midia'] = $request->file('arquivo')->store('postagens', 'public');
        }

        $postagem->update($data);

        return redirect()->route('admin.postagens.index')->with('success', 'Postagem atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postagem $postagem)
    {
        if ($postagem->url_midia && Storage::disk('public')->exists($postagem->url_midia)) {
            Storage::disk('public')->delete($postagem->url_midia);
        }

        $postagem->delete();

        return redirect()->route('admin.postagens.index')->with('success', 'Postagem excluída com sucesso!');
    }
}
