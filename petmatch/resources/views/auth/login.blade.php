@extends('layouts.app')

@section('content')
<div class="card shadow" style="max-width: 400px; width: 100%; margin: 0 auto;">
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="PetMatch" width="100">
            <h3 class="mt-3">Login PetMatch</h3>
        </div>

        {{-- Exibe erros gerais --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}">

                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
