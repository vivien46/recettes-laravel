// dashboardCharts.js
import Chart from 'chart.js/auto';
import ChartDataLabels from 'chartjs-plugin-datalabels';

Chart.register(ChartDataLabels); // Enregistrer le plugin

// Fonction pour obtenir les couleurs foncées
const getDarkColors = () => [
    '#FF6384', // Rouge foncé
    '#36A2EB', // Bleu foncé
    '#FFCE56', // Jaune foncé
    '#4BC0C0', // Vert foncé
];

// Graphique de répartition des recettes par mois
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('recipesChart');
    if (ctx) {
        new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: JSON.parse(ctx.dataset.months),
                datasets: [{
                    label: 'Recettes ajoutées',
                    data: JSON.parse(ctx.dataset.recipes),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 2
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 20,
                                weight: 'bold',
                            },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        callbacks: {
                            title: function(context) {
                                return context[0].label.toUpperCase();
                            },
                            label: function(context) {
                                const label = context.dataset.label || '';
                                const value = context.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Graphique en camembert pour la répartition par type
    const typeCtx = document.getElementById('typesChart');
    if (typeCtx) {
        new Chart(typeCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: JSON.parse(typeCtx.dataset.types).map(type => type.toUpperCase()),
                datasets: [{
                    data: JSON.parse(typeCtx.dataset.counts),
                    backgroundColor: getDarkColors(),
                    hoverBackgroundColor: getDarkColors(),
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            font: {
                                size: 20,
                                weight: 'bold',
                            },
                            color: '#333'
                        }
                    },
                    tooltip: {
                        titleFont: {
                            size: 16
                        },
                        bodyFont: {
                            size: 14
                        },
                        callbacks: {
                            title: function(context) {
                                return context[0].label.toUpperCase();
                            },
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((sum, val) => sum + val, 0);
                                const percentage = ((value / total) * 100).toFixed(2);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    },
                    datalabels: {
                        color: '#000',
                        font: {
                            weight: 'bold',
                            size: 16,
                        },
                        offset: 10,
                        padding: {
                            top: 10,
                            bottom: 10
                        },
                        anchor: 'end',
                        align: 'start',
                        formatter: (value, context) => {
                            const total = context.chart.data.datasets[0].data.reduce((sum, val) => sum + val, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${percentage}%`;
                        }
                    }
                }
            }
        });
    }
});
