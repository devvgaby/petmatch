<?php

namespace App\Http\Controllers\Tutor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PetMatch;
use App\Models\Mensagem;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $petsIds = $user->pets->pluck('id');

        $matches = PetMatch::where('status', 'aceito')
            ->where(function ($q) use ($petsIds) {
                $q->whereIn('pet1_id', $petsIds)->orWhereIn('pet2_id', $petsIds);
            })
            ->get();

        return view('tutor.chats.index', compact('matches'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $match = PetMatch::findOrFail($id);

        $petsIds = $user->pets->pluck('id')->toArray();

        if (!in_array($match->pet1_id, $petsIds) && !in_array($match->pet2_id, $petsIds)) {
            abort(403, 'Você não tem permissão para acessar esta conversa.');
        }

        $mensagens = Mensagem::where('match_id', $match->id)->orderBy('created_at')->get();

        $tutor1Id = $match->pet1->usuario_id;
        $tutor2Id = $match->pet2->usuario_id;
        $interlocutorId = ($tutor1Id == $user->id) ? $tutor2Id : $tutor1Id;

        return view('tutor.chats.show', compact('match', 'mensagens', 'interlocutorId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'match_id' => 'required|exists:matches,id',
            'conteudo' => 'required|string',
            'destinatario_id' => 'required|exists:usuarios,id',
        ]);

        $user = auth()->user();
        $match = PetMatch::findOrFail($request->match_id);
        $petsIds = $user->pets->pluck('id')->toArray();

        if (!in_array($match->pet1_id, $petsIds) && !in_array($match->pet2_id, $petsIds)) {
            abort(403, 'Você não tem permissão para enviar mensagens neste chat.');
        }

        Mensagem::create([
            'remetente_id' => $user->id,
            'destinatario_id' => $request->destinatario_id,
            'match_id' => $request->match_id,
            'conteudo' => $request->conteudo,
        ]);

        return redirect()->route('tutor.chats.show', $request->match_id)->with('success', 'Mensagem enviada!');
    }
}
