@extends('layouts.admin')

@section('title', 'Gerenciar Eventos')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Lista de Eventos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.eventos.create') }}" class="btn btn-success mb-3">➕ Novo Evento</a>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Data e Hora</th>
                    <th>Local</th>
                    <th>Máx. Participantes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventos as $evento)
                    <tr>
                        <td>{{ $evento->id }}</td>
                        <td>{{ $evento->titulo }}</td>
                        <td>{{ $evento->data_hora->format('d/m/Y H:i') }}</td>
                        <td>{{ $evento->local }}</td>
                        <td>{{ $evento->max_participantes ?? '---' }}</td>
                        <td>
                            <a href="{{ route('admin.eventos.edit', $evento->id) }}" class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{ route('admin.eventos.destroy', $evento->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Confirma exclusão do evento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum evento encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

