@props(['id', 'title', 'labels', 'values', 'type' => 'bar'])

<div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md mb-6">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h3 class="text-lg font-bold text-gray-800 tracking-tight">{{ $title }}</h3>
            <p class="text-sm text-gray-400">Yearly enrollment distribution analysis</p>
        </div>
        <div class="bg-blue-50 p-3 rounded-xl">
            <i class="fas fa-chart-line text-blue-600"></i>
        </div>
    </div>
    
    <div id="{{ $id }}" class="min-h-[350px]"></div> 
</div>

@push('scripts')
<script>
    (function renderChart() {
        if (typeof ApexCharts === 'undefined') {
            setTimeout(renderChart, 500);
            return;
        }

        const options = {
            series: [{
                name: 'Students Count',
                data: @json($values)
            }],
            chart: {
                type: '{{ $type }}',
                height: 350,
                fontFamily: 'Inter, sans-serif',
                toolbar: { show: false },
                animations: { enabled: true, speed: 1000 }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100]
                }
            },
            colors: ['#3b82f6'], // Modern Blue
            plotOptions: {
                bar: {
                    borderRadius: 10,
                    columnWidth: '40%',
                    distributed: true,
                    dataLabels: {
                        position: 'top', // Show count on top of bar
                    },
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + " Students";
                },
                offsetY: -25,
                style: {
                    fontSize: '12px',
                    fontWeight: 'bold',
                    colors: ["#1e293b"]
                }
            },
            xaxis: {
                categories: @json($labels),
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: {
                    style: { colors: '#64748b', fontSize: '12px', fontWeight: 500 }
                }
            },
            yaxis: {
                show: true,
                labels: {
                    style: { colors: '#94a3b8' }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4,
            },
            tooltip: {
                theme: 'light',
                y: {
                    formatter: function (val) {
                        return val + " Registered Students"
                    }
                }
            },
            legend: { show: false }
        };

        const chart = new ApexCharts(document.querySelector("#{{ $id }}"), options);
        chart.render();
    })();
</script>
@endpush