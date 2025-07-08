@extends('layouts.tutor')

@section('title', 'Dashboard')

@section('content')
<h4 class="mb-4">Olá, {{ Auth::user()->nome }}! 👋</h4>
<p>Bem-vindo ao seu painel. Aqui está um resumo das suas atividades:</p>

<div class="row">
    <div class="col-md-6">
        <canvas id="graficoResumo" height="300"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoResumo').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pets', 'Postagens', 'Eventos', 'Matches'],
            datasets: [{
                label: 'Total',
                data: [
                    {{ $totalPets }},
                    {{ $totalPostagens }},
                    {{ $totalEventos }},
                    {{ $totalMatches }}
                ],
                backgroundColor: [
                    '#7CB77B',
                    '#D97904',
                    '#FFB347',
                    '#9B59B6'
                ],
                borderRadius: 10,
                borderWidth: 1
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                }
            }
        }
    });
</script>
@endsection
