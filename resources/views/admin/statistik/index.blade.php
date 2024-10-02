@extends('layouts.admin.app')
@section('title')
    {{ $title }}
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card-body">
                    <div class="row">
                        @foreach ($jobs as $job)
                            <div class="col-md-12 mb-3">
                                <div class="card rounded-4 shadow-sm">
                                    <div class="card-body" id="{{ Str::slug($job) }}Chart"></div>
                                    @include('admin.partials.statistik-table', [
                                        'tableId' => Str::slug($job) . '-table',
                                        'dataUrl' => route('statistik.job-data', ['job' => $job]),
                                        'title' => $job,
                                        'currentMonthName' => $currentMonthName,
                                        'lastMonthName' => $lastMonthName,
                                    ])
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('dist/libs/apexcharts/dist/apexcharts.min.js?1692870487') }}" defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentYear = {{ $currentYear }};
            var lastYear = {{ $lastYear }};
            var chartData = @json($chartData);

            Object.keys(chartData).forEach(function(job) {
                var chartOptions = {
                    series: chartData[job].series,
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: chartData[job].categories,
                    },
                    yaxis: {
                        title: {
                            text: 'Jumlah Kegiatan'
                        }
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        theme: 'dark',
                        y: {
                            formatter: function(val) {
                                return val + " kegiatan"
                            }
                        }
                    },
                    grid: {
                        strokeDashArray: 4
                    },
                    title: {
                        text: job + ' ' + lastYear + ' & ' + currentYear,
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 600
                        }
                    },
                    legend: {
                        position: 'top'
                    }
                };

                var chart = new ApexCharts(document.querySelector("#" + job.toLowerCase().replace(/\s+/g,
                    '-') + "Chart"), chartOptions);
                chart.render();
            });
        });
    </script>
@endpush
