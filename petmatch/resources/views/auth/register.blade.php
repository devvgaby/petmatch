@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow w-100" style="max-width: 600px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="PetMatch" width="100">
                <h3 class="mt-3">Criar Conta</h3>
            </div>

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" value="{{ old('nome') }}" class="form-control" required>
                        @error('nome')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" value="{{ old('telefone') }}" class="form-control">
                        @error('telefone')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" id="cep" value="{{ old('cep') }}" class="form-control" maxlength="9" required>
                        @error('cep')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Endereço Completo</label>
                        <input type="text" name="endereco" id="endereco" value="{{ old('endereco') }}" class="form-control" readonly required>
                        @error('endereco')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirme a Senha</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const cepInput = document.getElementById('cep');
    const enderecoInput = document.getElementById('endereco');

    cepInput.addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert('CEP inválido! Informe os 8 dígitos.');
            enderecoInput.removeAttribute('readonly');
            enderecoInput.value = '';
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert('CEP não encontrado! Por favor, preencha o endereço manualmente.');
                    enderecoInput.removeAttribute('readonly');
                    enderecoInput.value = '';
                    return;
                }

                const enderecoCompleto = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                enderecoInput.value = enderecoCompleto;
                enderecoInput.setAttribute('readonly', true);

                buscarCoordenadas(enderecoCompleto);
            })
            .catch(() => {
                alert('Erro ao consultar o CEP! Por favor, preencha o endereço manualmente.');
                enderecoInput.removeAttribute('readonly');
                enderecoInput.value = '';
            });
    });

    function buscarCoordenadas(endereco) {
        const url = "https://nominatim.openstreetmap.org/search?format=json&limit=1&q=" + encodeURIComponent(endereco);

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.length) {
                    document.getElementById('latitude').value = data[0].lat;
                    document.getElementById('longitude').value = data[0].lon;
                } else {
                    alert('Não foi possível obter as coordenadas do endereço.');
                }
            })
            .catch(() => alert('Erro ao buscar coordenadas.'));
    }
</script>
@endsection
