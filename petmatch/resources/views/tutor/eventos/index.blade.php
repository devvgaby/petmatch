@extends('layouts.tutor')

@section('title', 'Meus Eventos')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tutor.eventos.create') }}" class="btn btn-primary mb-3">Criar Novo Evento</a>

    @if($eventos->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Data e Hora</th>
                    <th>Local</th>
                    <th>Máx. Participantes</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($eventos as $evento)
                    <tr>
                        <td>{{ $evento->titulo }}</td>
                        <td>{{ $evento->data_hora->format('d/m/Y H:i') }}</td>
                        <td>{{ $evento->local }}</td>
                        <td>{{ $evento->max_participantes ?? 'Ilimitado' }}</td>
                        <td>
                            <a href="{{ route('tutor.eventos.show', $evento) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('tutor.eventos.edit', $evento) }}" class="btn btn-warning btn-sm">Editar</a>

                            <form action="{{ route('tutor.eventos.destroy', $evento) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirma exclusão do evento?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $eventos->links() }}
    @else
        <p>Você ainda não criou nenhum evento.</p>
    @endif
@endsection

