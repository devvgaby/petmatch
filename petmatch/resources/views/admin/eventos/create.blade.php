@extends('layouts.admin')

@section('title', 'Criar Evento')

@section('content')
<form action="{{ route('admin.eventos.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="titulo" class="form-label">Título *</label>
        <input type="text" name="titulo" id="titulo" class="form-control @error('titulo') is-invalid @enderror"
            value="{{ old('titulo') }}" required>
        @error('titulo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao"
            class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>
        @error('descricao')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="data_hora" class="form-label">Data e Hora *</label>
        <input type="datetime-local" name="data_hora" id="data_hora"
            class="form-control @error('data_hora') is-invalid @enderror" value="{{ old('data_hora') }}" required>
        @error('data_hora')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cep" class="form-label">CEP *</label>
        <input type="text" id="cep" class="form-control" maxlength="9" placeholder="Digite o CEP">
    </div>

    <div class="mb-3">
        <label for="local" class="form-label">Endereço Completo *</label>
        <input type="text" name="local" id="local" class="form-control @error('local') is-invalid @enderror"
            value="{{ old('local') }}" required readonly>
        @error('local')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

    <div class="mb-3">
        <label for="max_participantes" class="form-label">Número máximo de participantes</label>
        <input type="number" name="max_participantes" id="max_participantes"
            class="form-control @error('max_participantes') is-invalid @enderror" value="{{ old('max_participantes') }}"
            min="1">
        @error('max_participantes')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Criar Evento</button>
    <a href="{{ route('admin.eventos.index') }}" class="btn btn-secondary ms-2">Cancelar</a>
</form>

<script>
    const baseUrl = "{{ url('admin/eventos/validar-cep') }}/";

    document.getElementById('cep').addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert('CEP deve conter 8 dígitos.');
            return;
        }

        fetch(baseUrl + cep)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert(data.erro);
                    document.getElementById('local').readOnly = false;
                    return;
                }

                document.getElementById('local').value = data.enderecoCompleto;
                document.getElementById('local').readOnly = true;

                buscarCoordenadas(data.enderecoCompleto);
            })
            .catch(() => {
                alert('Erro ao consultar o CEP. Preencha o endereço manualmente.');
                document.getElementById('local').readOnly = false;
            });
    });

    function buscarCoordenadas(endereco) {
        fetch("{{ route('admin.eventos.obterGeolocalizacao') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ endereco: endereco })
        })
            .then(response => response.json())
            .then(data => {
                if (data.latitude && data.longitude) {
                    document.getElementById('latitude').value = data.latitude;
                    document.getElementById('longitude').value = data.longitude;
                } else {
                    alert('Não foi possível obter as coordenadas.');
                }
            })
            .catch(() => alert('Erro ao buscar coordenadas.'));
    }
</script>
@endsection
