@extends('layouts.tutor')

@section('title', 'Dashboard')

@section('content')
<h4 class="mb-4">Olá, {{ Auth::user()->nome }}! 👋</h4>
    <p>Bem-vindo ao seu painel, aqui você verá um resumo dos seus pets, postagens e atividades recentes.</p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Pets cadastrados</h5>
                    <p class="card-text display-4">5</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Postagens feitas</h5>
                    <p class="card-text display-4">12</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">Eventos inscritos</h5>
                    <p class="card-text display-4">3</p>
                </div>
            </div>
        </div>
    </div>
@endsection

