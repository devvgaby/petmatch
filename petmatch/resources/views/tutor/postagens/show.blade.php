@extends('layouts.tutor')

@section('title', 'Detalhes da Postagem')

@section('content')
    <h4 class="mb-3">Postagem de {{ $postagem->pet->nome ?? 'Pet' }}</h4>

    <p>{{ $postagem->descricao }}</p>

    @if($postagem->url_midia)
        @if($postagem->tipo_midia === 'imagem')
            <img src="{{ asset('storage/' . $postagem->url_midia) }}" alt="Mídia" class="img-fluid mb-3">
        @elseif($postagem->tipo_midia === 'video')
            <video controls width="400" class="mb-3">
                <source src="{{ asset('storage/' . $postagem->url_midia) }}" type="video/mp4">
                Seu navegador não suporta vídeo HTML5.
            </video>
        @endif
    @endif

    <hr>

    <h5>Comentários</h5>

    @foreach($postagem->comentarios as $comentario)
        <div class="border p-2 mb-2">
            <strong>{{ $comentario->usuario->nome ?? 'Usuário' }}</strong> disse:
            <p>{{ $comentario->conteudo }}</p>

            @if($comentario->usuario_id == auth()->id())
                <form action="{{ route('tutor.comentarios.destroy', $comentario->id) }}" method="POST"
                    onsubmit="return confirm('Excluir comentário?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Excluir</button>
                </form>
            @endif
        </div>
    @endforeach

    <hr>

    <h5>Adicionar Comentário</h5>
    <form action="{{ route('tutor.comentarios.store', $postagem->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="conteudo" class="form-control" rows="3" placeholder="Escreva seu comentário..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Comentar</button>
    </form>

    <a href="{{ route('tutor.postagens.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
