@extends('layouts.admin')

@section('title', 'Editar Postagem')

@section('content')
<div class="card p-4 shadow-sm bg-white rounded">
    <h2 class="mb-4">Editar Postagem</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Ops!</strong> Corrija os erros abaixo:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.postagens.update', $postagem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" id="descricao" rows="3" class="form-control">{{ old('descricao', $postagem->descricao) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="tipo_midia" class="form-label">Tipo de Mídia</label>
            <select name="tipo_midia" id="tipo_midia" class="form-select" required>
                <option value="imagem" {{ old('tipo_midia', $postagem->tipo_midia) == 'imagem' ? 'selected' : '' }}>Imagem</option>
                <option value="video" {{ old('tipo_midia', $postagem->tipo_midia) == 'video' ? 'selected' : '' }}>Vídeo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="arquivo" class="form-label">Arquivo da Mídia (se quiser trocar)</label>
            <input type="file" name="arquivo" id="arquivo" class="form-control">
            @if($postagem->url_midia)
                <div class="mt-2">
                    @if($postagem->tipo_midia === 'imagem')
                        <img src="{{ asset('storage/' . $postagem->url_midia) }}" alt="Imagem" width="120">
                    @elseif($postagem->tipo_midia === 'video')
                        <video src="{{ asset('storage/' . $postagem->url_midia) }}" width="200" controls></video>
                    @endif
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="pet_id" class="form-label">Pet</label>
            <select name="pet_id" id="pet_id" class="form-select" required>
                @foreach($pets as $pet)
                    <option value="{{ $pet->id }}" {{ old('pet_id', $postagem->pet_id) == $pet->id ? 'selected' : '' }}>
                        {{ $pet->nome }} (Tutor: {{ $pet->usuario?->nome ?? '---' }})
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Atualizar</button>
        <a href="{{ route('admin.postagens.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
    