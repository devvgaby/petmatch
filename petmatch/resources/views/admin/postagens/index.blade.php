@extends('layouts.admin')

@section('title', 'Gerenciar Postagens')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Lista de Postagens</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('admin.postagens.create') }}" class="btn btn-success">➕ Nova Postagem</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Mídia</th>
                    <th>Tipo</th>
                    <th>Pet</th>
                    <th>Tutor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($postagens as $postagem)
                    <tr>
                        <td>{{ $postagem->id }}</td>
                        <td>{{ $postagem->descricao ?? '---' }}</td>
                        <td>
                            @if($postagem->tipo_midia === 'imagem')
                                <img src="{{ asset('storage/' . $postagem->url_midia) }}" alt="Imagem" width="70">
                            @elseif($postagem->tipo_midia === 'video')
                                <video src="{{ asset('storage/' . $postagem->url_midia) }}" width="150" controls></video>
                            @endif
                        </td>
                        <td>{{ ucfirst($postagem->tipo_midia) }}</td>
                        <td>{{ $postagem->pet?->nome ?? '---' }}</td>
                        <td>{{ $postagem->pet?->usuario?->nome ?? '---' }}</td>
                        <td>
                            <a href="{{ route('admin.postagens.edit', $postagem->id) }}" class="btn btn-sm btn-primary">Editar</a>

                            <form action="{{ route('admin.postagens.destroy', $postagem->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja deletar esta postagem?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Nenhuma postagem encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $postagens->links() }}
    </div>
</div>
@endsection
