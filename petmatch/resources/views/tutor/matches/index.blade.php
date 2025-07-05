@extends('layouts.tutor')

@section('title', 'Descobrir Pets')

@section('content')
    <div class="container">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4">Encontre novos amigos para seu Pet</h2>

            @if ($meusPets->isEmpty())
                <div class="alert alert-warning">Cadastre um pet para começar a buscar amigos!</div>
            @else
                <form method="GET" action="{{ route('tutor.matches.index') }}" class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="pet_id" class="form-label">Selecione o Pet</label>
                        <select name="pet_id" id="pet_id" class="form-select" required>
                            @foreach ($meusPets as $pet)
                                <option value="{{ $pet->id }}" {{ request('pet_id') == $pet->id ? 'selected' : '' }}>
                                    {{ $pet->nome }} ({{ ucfirst($pet->especie) }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-search-heart me-2"></i> Buscar Compatíveis
                        </button>
                    </div>
                </form>

                @if ($petsCompativeis->isEmpty())
                    <div class="alert alert-info">Nenhum pet compatível encontrado no momento.</div>
                @else
                    <div class="row">
                        @foreach ($petsCompativeis as $pet)
                            <div class="col-md-4 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/' . $pet->foto_perfil_url) }}" class="card-img-top" alt="Foto do Pet">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $pet->nome }} ({{ ucfirst($pet->especie) }})</h5>
                                        <p class="card-text"><strong>Idade:</strong> {{ $pet->idade }} anos</p>
                                        <p class="card-text">{{ $pet->descricao }}</p>
                                        <form method="POST" action="{{ route('tutor.matches.store') }}"
                                            class="d-flex justify-content-between">
                                            @csrf
                                            <input type="hidden" name="pet1_id" value="{{ request('pet_id') }}">
                                            <input type="hidden" name="pet2_id" value="{{ $pet->id }}">
                                            <input type="hidden" name="status" value="pendente">
                                            <button type="submit" class="btn btn-success w-50">
                                                <i class="bi bi-heart-fill me-1"></i> Curtir
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('tutor.matches.destroy', $pet->id) }}" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="pet1_id" value="{{ request('pet_id') }}">
                                            <button type="submit" class="btn btn-outline-danger w-100">
                                                <i class="bi bi-x-circle"></i> Descartar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection