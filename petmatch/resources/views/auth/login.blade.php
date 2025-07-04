@extends('layouts.app')

@section('content')
<div class="card shadow" style="max-width: 400px; width: 100%;">
    <div class="card-body">
        <div class="text-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="PetMatch" width="100">
            <h3 class="mt-3">Login PetMatch</h3>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </form>
    </div>
</div>
@endsection
