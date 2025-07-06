@extends('layouts.tutor')

@section('title', 'Chat entre Tutores')

@section('content')
    <h2>Chat sobre o match #{{ $match->id }}</h2>

    <div class="chat-box mb-4 p-3"
        style="max-height: 400px; overflow-y: auto; border: 1px solid #ccc; background: #fafafa;">
        @forelse($mensagens as $mensagem)
            @php
                $isRemetente = $mensagem->remetente_id == auth()->id();
            @endphp
            <div class="mb-2 text-{{ $isRemetente ? 'end' : 'start' }}">
                <div style="display: inline-block; padding: 0.5rem 0.75rem; border-radius: 15px; 
                                    background-color: {{ $isRemetente ? '#7CB77B' : '#e0e0e0' }};
                                    color: {{ $isRemetente ? 'white' : 'black' }};
                                    max-width: 70%;">
                    <small>{{ $mensagem->remetente->name ?? 'Você' }}</small><br>
                    {{ $mensagem->conteudo }}
                    <br>
                    <small
                        class="text-muted">{{ $mensagem->created_at->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        @empty
            <p>Nenhuma mensagem nesta conversa ainda.</p>
        @endforelse
    </div>

    <form action="{{ route('tutor.chats.store') }}" method="POST">
        @csrf
        <input type="hidden" name="match_id" value="{{ $match->id }}">
        <input type="hidden" name="destinatario_id" value="{{ $interlocutorId }}">

        <div class="mb-3">
            <textarea name="conteudo" class="form-control @error('conteudo') is-invalid @enderror" rows="3"
                placeholder="Digite sua mensagem aqui...">{{ old('conteudo') }}</textarea>
            @error('conteudo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Enviar</button>
        <a href="{{ route('tutor.chats.index') }}" class="btn btn-secondary ms-2">Voltar</a>
    </form>
@endsection