@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<h4 class="mb-4">Olá, {{ Auth::user()->nome }}! 👋</h4>
<div class="container">

    <div class="row mb-4">
        @foreach([
            ['label' => 'Total de Usuários', 'value' => $totalUsuarios, 'color' => 'primary'],
            ['label' => 'Total de Pets', 'value' => $totalPets, 'color' => 'success'],
            ['label' => 'Total de Matches', 'value' => $totalMatches, 'color' => 'warning'],
            ['label' => 'Eventos Criados', 'value' => $eventosCriados, 'color' => 'info'],
            ['label' => 'Usuários Ativos (Últimas 24h)', 'value' => $usuariosAtivos, 'color' => 'danger'],
        ] as $item)
        <div class="col-md-2 mb-3">
            <div class="card text-white bg-{{ $item['color'] }} shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $item['label'] }}</h5>
                    <p class="display-5">{{ $item['value'] }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Distribuição por Espécie</h5>
            <canvas id="chartEspecies"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Raças Mais Populares (Top 5)</h5>
            <canvas id="chartRacas"></canvas>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Crescimento de Usuários e Pets (Últimas 5 semanas)</h5>
            <canvas id="chartCrescimento"></canvas>
        </div>
        <div class="col-md-6">
            <h5>Atividade de Matches e Conversas (Quantidade por Semana)</h5>
            <canvas id="chartAtividade"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Distribuição por espécie
    const especiesLabels = @json($distribuicaoEspecies->pluck('especie'));
    const especiesData = @json($distribuicaoEspecies->pluck('total'));

    // Raças mais populares
    const racasLabels = @json($racasPopulares->pluck('raca'));
    const racasData = @json($racasPopulares->pluck('total'));

    // Função para gerar labels semana/ano para crescimento e atividade
    function gerarLabelsSemanas(dados) {
        return dados.map(d => `Semana ${d.semana} / ${d.ano}`);
    }

    // Crescimento Usuários e Pets
    const crescimentoUsuarios = @json($crescimentoUsuarios);
    const crescimentoPets = @json($crescimentoPets);

    const labelsCrescimento = gerarLabelsSemanas(crescimentoUsuarios);

    const dadosUsuarios = crescimentoUsuarios.map(d => d.total);
    const dadosPets = crescimentoPets.map(d => d.total);

    // Atividade Matches e Conversas
    const atividadeMatches = @json($atividadeMatches);
    const atividadeConversas = @json($atividadeConversas);

    const labelsAtividade = gerarLabelsSemanas(atividadeMatches);

    const dadosMatches = atividadeMatches.map(d => d.total);
    const dadosConversas = atividadeConversas.map(d => d.total);

    // Configuração dos gráficos
    const ctxEspecies = document.getElementById('chartEspecies').getContext('2d');
    const chartEspecies = new Chart(ctxEspecies, {
        type: 'doughnut',
        data: {
            labels: especiesLabels,
            datasets: [{
                label: 'Distribuição por Espécie',
                data: especiesData,
                backgroundColor: [
                    '#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796'
                ],
            }]
        }
    });

    const ctxRacas = document.getElementById('chartRacas').getContext('2d');
    const chartRacas = new Chart(ctxRacas, {
        type: 'bar',
        data: {
            labels: racasLabels,
            datasets: [{
                label: 'Raças Mais Populares',
                data: racasData,
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    const ctxCrescimento = document.getElementById('chartCrescimento').getContext('2d');
    const chartCrescimento = new Chart(ctxCrescimento, {
        type: 'line',
        data: {
            labels: labelsCrescimento,
            datasets: [
                {
                    label: 'Usuários',
                    data: dadosUsuarios,
                    borderColor: '#4e73df',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Pets',
                    data: dadosPets,
                    borderColor: '#1cc88a',
                    fill: false,
                    tension: 0.3
                }
            ]
        }
    });

    const ctxAtividade = document.getElementById('chartAtividade').getContext('2d');
    const chartAtividade = new Chart(ctxAtividade, {
        type: 'line',
        data: {
            labels: labelsAtividade,
            datasets: [
                {
                    label: 'Matches',
                    data: dadosMatches,
                    borderColor: '#f6c23e',
                    fill: false,
                    tension: 0.3
                },
                {
                    label: 'Conversas',
                    data: dadosConversas,
                    borderColor: '#e74a3b',
                    fill: false,
                    tension: 0.3
                }
            ]
        }
    });
</script>
@endsection

