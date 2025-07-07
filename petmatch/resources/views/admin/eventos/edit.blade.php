@extends('layouts.admin')

@section('title', 'Editar Evento')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Editar Evento</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.eventos.update', $evento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" value="{{ old('titulo', $evento->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" rows="4" class="form-control">{{ old('descricao', $evento->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="data_hora" class="form-label">Data e Hora</label>
            <input type="datetime-local" name="data_hora" id="data_hora" class="form-control" 
                value="{{ old('data_hora', $evento->data_hora ? $evento->data_hora->format('Y-m-d\TH:i') : '') }}" required>
        </div>

        <div class="mb-3">
            <label for="local" class="form-label">Local</label>
            <input type="text" name="local" id="local" class="form-control" value="{{ old('local', $evento->local) }}" required>
        </div>

        <div class="mb-3">
            <label for="max_participantes" class="form-label">Máximo de Participantes</label>
            <input type="number" name="max_participantes" id="max_participantes" class="form-control" 
                value="{{ old('max_participantes', $evento->max_participantes) }}" min="1" placeholder="Opcional">
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

