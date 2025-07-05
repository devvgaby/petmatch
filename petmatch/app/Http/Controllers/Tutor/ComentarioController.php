<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;
use App\Http\Requests\StoreComentarioRequest;

class ComentarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComentarioRequest $request, $postagemId)
    {
        Comentario::create([
            'conteudo' => $request->conteudo,
            'usuario_id' => Auth::id(),
            'postagem_id' => $postagemId,
        ]);

        return redirect()->route('tutor.postagens.show', $postagemId)
            ->with('success', 'Comentário adicionado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comentario = Comentario::findOrFail($id);

        if ($comentario->usuario_id != Auth::id()) {
            abort(403); 
        }

        $comentario->delete();

        return redirect()->route('tutor.postagens.show', $comentario->postagem_id)
            ->with('success', 'Comentário excluído com sucesso!');
    }
}
