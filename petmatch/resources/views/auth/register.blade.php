@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow w-100" style="max-width: 600px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="PetMatch" width="100">
                <h3 class="mt-3">Criar Conta</h3>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">E-mail</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" maxlength="9" required>
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label">Endereço Completo</label>
                        <input type="text" name="endereco" id="endereco" class="form-control" readonly required>
                    </div>

                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
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

    cepInput.addEventListener('blur', function () {
        const cep = this.value.replace(/\D/g, '');

        if (cep.length !== 8) {
            alert('CEP inválido! Informe os 8 dígitos.');
            return;
        }

        fetch(`https://viacep.com.br/ws/${cep}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert('CEP não encontrado!');
                    return;
                }

                const enderecoCompleto = `${data.logradouro}, ${data.bairro}, ${data.localidade} - ${data.uf}`;
                document.getElementById('endereco').value = enderecoCompleto;


            })
            .catch(() => alert('Erro ao consultar o CEP!'));
    });
</script>
@endsection
