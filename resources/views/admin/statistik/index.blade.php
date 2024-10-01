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
                        <div class="col-md-12 mb-3">
                            <div class="card rounded-4 shadow-sm">
                                <div class="card-body" id="itSupportChart"></div>
                                @include('admin.partials.statistik-table', [
                                    'tableId' => 'it-support-table',
                                    'dataUrl' => route('statistik.it-support-data'),
                                    'title' => 'IT Support',
                                ])
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="card rounded-4 shadow-sm">
                                <div class="card-body" id="thlChart"></div>
                                @include('admin.partials.statistik-table', [
                                    'tableId' => 'thl-table',
                                    'dataUrl' => route('statistik.thl-data'),
                                    'title' => 'THL',
                                ])
                            </div>
                        </div>
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

            var itSupportChartOptions = {
                series: @json($itSupportChartData['series']),
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
                    categories: @json($itSupportChartData['categories']),
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
                    text: 'IT Support ' + lastYear + ' & ' + currentYear,
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

            var itSupportChart = new ApexCharts(document.querySelector("#itSupportChart"), itSupportChartOptions);
            itSupportChart.render();

            var thlChartOptions = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '50%',
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
                yaxis: {
                    title: {
                        text: 'Jumlah Kegiatan',
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
                legend: {
                    position: 'top'
                },
                series: @json($thlChartData['series']),
                xaxis: {
                    categories: @json($thlChartData['categories']),
                },
                title: {
                    text: 'THL ' + lastYear + ' & ' + currentYear,
                    align: 'center',
                    style: {
                        fontSize: '16px',
                        fontWeight: 600
                    }
                }
            };

            var thlChart = new ApexCharts(document.querySelector("#thlChart"), thlChartOptions);
            thlChart.render();
        });
    </script>
@endpush
