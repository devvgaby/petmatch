@extends('layouts.tutor')

@section('title', 'Editar Postagem')

@section('content')
    <h4 class="mb-4">Editar Postagem</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tutor.postagens.update', $postagem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição *</label>
            <textarea name="descricao" id="descricao" class="form-control" rows="3"
                required>{{ old('descricao', $postagem->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="pet_id" class="form-label">Pet *</label>
            <select name="pet_id" id="pet_id" class="form-select" required>
                <option value="">Selecione</option>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ old('pet_id', $postagem->pet_id) == $pet->id ? 'selected' : '' }}>
                        {{ $pet->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="url_midia" class="form-label">Atualizar Mídia (imagem ou vídeo)</label>
            <input type="file" name="url_midia" id="url_midia" class="form-control" accept="image/*,video/*">
            @if($postagem->url_midia)
                <small>Arquivo atual:</small><br>
                @if($postagem->tipo_midia === 'imagem')
                    <img src="{{ asset('storage/' . $postagem->url_midia) }}" alt="Mídia atual" style="max-width: 200px;">
                @elseif($postagem->tipo_midia === 'video')
                    <video controls width="300">
                        <source src="{{ asset('storage/' . $postagem->url_midia) }}" type="video/mp4">
                        Seu navegador não suporta vídeo HTML5.
                    </video>
                @endif
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="{{ route('tutor.postagens.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection