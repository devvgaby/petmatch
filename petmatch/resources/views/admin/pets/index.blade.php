@extends('layouts.admin')

@section('title', 'Gerenciar Pets')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Lista de Pets</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Raça</th>
                    <th>Idade</th>
                    <th>Sexo</th>
                    <th>Tutor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pets as $pet)
                    <tr>
                        <td>{{ $pet->id }}</td>
                        <td>{{ $pet->nome }}</td>
                        <td>{{ ucfirst($pet->especie) }}</td>
                        <td>{{ $pet->raca ?? '---' }}</td>
                        <td>{{ $pet->idade_formatada }}</td>
                        <td>{{ ucfirst($pet->sexo) }}</td>
                        <td>{{ $pet->usuario?->nome ?? '---' }}</td>
                        <td>
                            <a href="{{ route('admin.pets.edit', $pet->id) }}" class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{ route('admin.pets.destroy', $pet->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja deletar este pet?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">Nenhum pet encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
