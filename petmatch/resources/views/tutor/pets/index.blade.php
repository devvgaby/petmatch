@extends('layouts.tutor')

@section('title', 'Meus Pets')

@section('content')

@php
function formatarIdade($meses) {
    $anos = intdiv($meses, 12);
    $mesesRestantes = $meses % 12;
    $partes = [];

    if ($anos > 0) {
        $partes[] = $anos . ' ano' . ($anos > 1 ? 's' : '');
    }
    if ($mesesRestantes > 0) {
        $partes[] = $mesesRestantes . ' mes' . ($mesesRestantes > 1 ? 'es' : '');
    }
    if (empty($partes)) {
        return '0 meses';
    }
    return implode(' e ', $partes);
}
@endphp

<h4 class="mb-4">Seus Pets 🐾</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($pets->isEmpty())
    <p>Você ainda não cadastrou nenhum pet.</p>
    <a href="{{ route('tutor.pets.create') }}" class="btn btn-primary">Cadastrar Pet</a>
@else
    <a href="{{ route('tutor.pets.create') }}" class="btn btn-primary mb-3">Adicionar Novo Pet</a>

    <div class="row">
        @foreach($pets as $pet)
            <div class="col-md-4 mb-3">
                <div class="card">
                    @if($pet->foto_perfil_url)
                        <img src="{{ asset('storage/' . $pet->foto_perfil_url) }}" class="card-img-top" alt="{{ $pet->nome }}">
                    @else
                        <img src="{{ asset('images/default-pet.png') }}" class="card-img-top" alt="Imagem padrão">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $pet->nome }}</h5>
                        <p class="card-text">
                            Espécie: {{ $pet->especie }}<br>
                            Raça: {{ $pet->raca ?? 'Não informada' }}<br>
                            Idade: {{ formatarIdade($pet->idade) }}<br>
                            Sexo: {{ ucfirst($pet->sexo) }}
                        </p>

                        <a href="{{ route('tutor.pets.edit', $pet->id) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

@endsection
