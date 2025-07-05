@extends('layouts.tutor')

@section('title', 'Cadastrar Pet')

@section('content')

    <h4 class="mb-4">Adicione um novo pet ao seu perfil 🐾</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Verifique os erros abaixo:<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tutor.pets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome do Pet *</label>
                <input type="text" name="nome" id="nome" class="form-control" required value="{{ old('nome') }}">
            </div>

            <div class="col-md-6">
                <label for="especie" class="form-label">Espécie *</label>
                <input type="text" name="especie" id="especie" class="form-control" required value="{{ old('especie') }}">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="raca" class="form-label">Raça</label>
                <input type="text" name="raca" id="raca" class="form-control" value="{{ old('raca') }}">
            </div>

            <div class="col-md-3">
                <label for="idade" class="form-label">Idade (em meses) *</label>
                <input type="number" name="idade" id="idade" class="form-control" required min="0"
                    value="{{ old('idade') }}">
            </div>


            <div class="col-md-3">
                <label for="sexo" class="form-label">Sexo *</label>
                <select name="sexo" id="sexo" class="form-select" required>
                    <option value="">Selecione</option>
                    <option value="macho" {{ old('sexo') == 'macho' ? 'selected' : '' }}>Macho</option>
                    <option value="femea" {{ old('sexo') == 'femea' ? 'selected' : '' }}>Fêmea</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3">{{ old('descricao') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="preferencias" class="form-label">Preferências de compatibilidade</label>
            <textarea name="preferencias" id="preferencias" class="form-control"
                rows="2">{{ old('preferencias') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto_perfil" class="form-label">Foto de Perfil do Pet</label>
            <input type="file" name="foto_perfil" id="foto_perfil" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Cadastrar Pet
        </button>
        <a href="{{ route('tutor.pets.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>

@endsection