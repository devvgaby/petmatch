@extends('layouts.tutor')

@section('title', 'Minhas Postagens')

@section('content')

<h4 class="mb-4">Minhas Postagens 📝</h4>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('tutor.postagens.create') }}" class="btn btn-primary mb-3">Nova Postagem</a>

@if($postagens->isEmpty())
    <p>Você ainda não fez nenhuma postagem.</p>
@else
    <div class="list-group">
        @foreach($postagens as $postagem)
            <div class="list-group-item mb-3">
                <p>{{ $postagem->descricao }}</p>
                @if($postagem->url_midia)
                    @if($postagem->tipo_midia === 'imagem')
                        <img src="{{ asset('storage/' . $postagem->url_midia) }}" alt="Mídia da postagem" class="img-fluid mb-2" style="max-width: 300px;">
                    @elseif($postagem->tipo_midia === 'video')
                        <video controls width="300" class="mb-2">
                            <source src="{{ asset('storage/' . $postagem->url_midia) }}" type="video/mp4">
                            Seu navegador não suporta vídeo HTML5.
                        </video>
                    @endif
                @endif
                <small>Pet: {{ $postagem->pet->nome ?? 'Desconhecido' }}</small>

                <div class="mt-2">
                    <a href="{{ route('tutor.postagens.edit', $postagem->id) }}" class="btn btn-warning btn-sm me-2">Editar</a>

                    <form action="{{ route('tutor.postagens.destroy', $postagem->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir esta postagem?')">Excluir</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
