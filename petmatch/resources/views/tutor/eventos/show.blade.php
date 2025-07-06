@extends('layouts.tutor')

@section('title', 'Detalhes do Evento')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>{{ $evento->titulo }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $evento->descricao ?? 'Nenhuma descrição' }}</p>
            <p><strong>Data e Hora:</strong> {{ $evento->data_hora->format('d/m/Y H:i') }}</p>
            <p><strong>Local:</strong> {{ $evento->local }}</p>
            <p><strong>Máx. Participantes:</strong> {{ $evento->max_participantes ?? 'Ilimitado' }}</p>
        </div>
        <div class="card-footer">
            <a href="{{ route('tutor.eventos.edit', $evento) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('tutor.eventos.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
@endsection

