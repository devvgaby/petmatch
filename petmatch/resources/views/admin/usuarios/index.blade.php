@extends('layouts.admin')

@section('title', 'Usuários')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>👥 Lista de Tutores</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->telefone ?? 'N/A' }}</td>
                    <td>{{ $usuario->endereco ?? 'N/A' }}</td>
                    <td>{{ $usuario->cep ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-sm btn-primary">
                            ✏️ Editar
                        </a>

                        <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Excluir</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Nenhum usuário encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection