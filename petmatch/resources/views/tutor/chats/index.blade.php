@extends('layouts.tutor')

@section('title', 'Minhas Conversas')

@section('content')
    <h2>Minhas Conversas</h2>

    @if ($matches->isEmpty())
        <p>Você ainda não tem conversas.</p>
    @else
        <ul class="list-group">
            @foreach ($matches as $match)
                @php
                    $userId = auth()->id();
                    $interlocutorPetId = ($match->pet1->usuario_id == $userId) ? $match->pet2->id : $match->pet1->id;
                    $interlocutorPetName = ($match->pet1->usuario_id == $userId) ? $match->pet2->nome : $match->pet1->nome;
                @endphp
                <li class="list-group-item">
                    <a href="{{ route('tutor.chats.show', $match->id) }}">
                        Conversa com tutor do pet "{{ $interlocutorPetName }}" 
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
