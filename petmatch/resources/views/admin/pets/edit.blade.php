@extends('layouts.admin')

@section('title', 'Editar Pet')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Editar Pet</h2>

    <form action="{{ route('admin.pets.update', $pet->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome *</label>
            <input type="text" id="nome" name="nome" class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome', $pet->nome) }}" required>
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="especie" class="form-label">Espécie *</label>
            <input type="text" id="especie" name="especie" class="form-control @error('especie') is-invalid @enderror" value="{{ old('especie', $pet->especie) }}" required>
            @error('especie')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="raca" class="form-label">Raça</label>
            <input type="text" id="raca" name="raca" class="form-control @error('raca') is-invalid @enderror" value="{{ old('raca', $pet->raca) }}">
            @error('raca')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="idade" class="form-label">Idade (anos) *</label>
            <input type="number" id="idade" name="idade" class="form-control @error('idade') is-invalid @enderror" value="{{ old('idade', $pet->idade) }}" min="0" required>
            @error('idade')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Sexo *</label>
            <select name="sexo" class="form-select @error('sexo') is-invalid @enderror" required>
                <option value="">Selecione</option>
                <option value="macho" {{ old('sexo', $pet->sexo) == 'macho' ? 'selected' : '' }}>Macho</option>
                <option value="femea" {{ old('sexo', $pet->sexo) == 'femea' ? 'selected' : '' }}>Fêmea</option>
            </select>
            @error('sexo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao', $pet->descricao) }}</textarea>
            @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="preferencias" class="form-label">Preferências</label>
            <textarea id="preferencias" name="preferencias" class="form-control @error('preferencias') is-invalid @enderror">{{ old('preferencias', $pet->preferencias) }}</textarea>
            @error('preferencias')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="foto_perfil_url" class="form-label">URL da Foto de Perfil</label>
            <input type="url" id="foto_perfil_url" name="foto_perfil_url" class="form-control @error('foto_perfil_url') is-invalid @enderror" value="{{ old('foto_perfil_url', $pet->foto_perfil_url) }}">
            @error('foto_perfil_url')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Tutor (Usuário) *</label>
            <select id="usuario_id" name="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                <option value="">Selecione o tutor</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ old('usuario_id', $pet->usuario_id) == $usuario->id ? 'selected' : '' }}>{{ $usuario->nome }} ({{ $usuario->email }})</option>
                @endforeach
            </select>
            @error('usuario_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('admin.pets.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
@endsection

