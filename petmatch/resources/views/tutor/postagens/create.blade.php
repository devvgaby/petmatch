@extends('layouts.tutor')

@section('title', 'Nova Postagem')

@section('content')

<h4 class="mb-4">Criar Nova Postagem 📝</h4>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ops!</strong> Verifique os erros abaixo:<br><br>
        <ul class="mb-0">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tutor.postagens.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição *</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="3" required>{{ old('descricao') }}</textarea>
    </div>

    <div class="mb-3">
        <label for="pet_id" class="form-label">Selecione o Pet *</label>
        <select name="pet_id" id="pet_id" class="form-select" required>
            <option value="">Selecione</option>
            @foreach($pets as $pet)
                <option value="{{ $pet->id }}" {{ old('pet_id') == $pet->id ? 'selected' : '' }}>{{ $pet->nome }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="url_midia" class="form-label">Adicionar Mídia (imagem ou vídeo)</label>
        <input type="file" name="url_midia" id="url_midia" class="form-control" accept="image/*,video/*">
    </div>

    <button type="submit" class="btn btn-success">Publicar</button>
    <a href="{{ route('tutor.postagens.index') }}" class="btn btn-secondary">Cancelar</a>
</form>

@endsection

