@extends('layouts.tutor')

@section('title', 'Editar Evento')

@section('content')
    <form action="{{ route('tutor.eventos.update', $evento) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título *</label>
            <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo', $evento->titulo) }}" required>
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $evento->descricao) }}</textarea>
            @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora *</label>
            <input type="datetime-local" name="data_hora" id="data_hora" class="form-control @error('data_hora') is-invalid @enderror" value="{{ old('data_hora', $evento->data_hora->format('Y-m-d\TH:i')) }}" required>
            @error('data_hora')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="local" class="form-label">Local *</label>
            <input type="text" name="local" id="local" class="form-control @error('local') is-invalid @enderror" value="{{ old('local', $evento->local) }}" required>
            @error('local')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="max_participantes" class="form-label">Número máximo de participantes</label>
            <input type="number" name="max_participantes" id="max_participantes" class="form-control @error('max_participantes') is-invalid @enderror" value="{{ old('max_participantes', $evento->max_participantes) }}" min="1">
            @error('max_participantes')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('tutor.eventos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
@endsection

