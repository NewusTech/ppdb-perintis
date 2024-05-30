@slot('title', 'Dashboard')

@push('styles')
<!-- DataTables -->
<link href="{{ URL::asset('/assets/libs/jquery-vectormap/jquery-vectormap.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ URL::asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@slot('titleBreadcrumb', 'PPDB')

@if (auth()->user()->roles->first()->name == 'siswa')
<div class="card">
    <div class="card-body">
        <div class="col-12 col-md-6 fixed-top mx-auto mt-2">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="mr-2 mdi mdi-check-all"></i>
                    {{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong><i class="mr-2 mdi mdi-alert-circle-outline"></i>
                {{ session('status') }}</strong>
        </div>
    </div>
</div>
@else
<div class="row items-center">
    <div class="col-1 flex">Tahun: </div>
    <div class="col-3 mb-2">
        <form method="GET" action="{{ route('dashboard') }}">
            <select class="form-control" name="tahun" aria-label="Default select example" onchange="this.form.submit()">
                @foreach ($tahun as $i)
                <option value="{{$i}}" @if($tahunSelected && $tahunSelected==$i) selected @endif>{{$i}}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
<div wire:poll.10s="refresh" class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Total</h4>
                <div id="pie_chart" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Jurusan Executive</h4>
                <div id="pie_chart_executive_jurusan" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Jurusan Reguler AC</h4>
                <div id="pie_chart_reguler_ac_jurusan" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Jurusan Reguler Non Ac</h4>

                <div id="pie_chart_non_ac_jurusan" class="apex-charts" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    function pieChart() {
        var executive = @this.executive;
        var reguler_ac = @this.reguler_ac;
        var non_ac = @this.non_ac;

        var options = {
            chart: {
                height: 300,
                type: "donut",
            },
            series: [executive, reguler_ac, non_ac],
            labels: [
                "Executive",
                "Reguler AC",
                "Reguler Non AC",
            ],
            colors: [
                "#198754",
                "#dc3545",
                "#0d6efd",
            ],
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 5,
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240,
                    },
                    legend: {
                        show: false,
                    },
                },
            }],
            plotOptions: {
                pie: {
                    expandOnClick: true,
                    donut: {
                        size: '45%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                            }
                        }
                    }
                }
            }
        };
        var chart = new ApexCharts(
            document.querySelector("#pie_chart"),
            options
        );
        chart.render();
    }

    function pieChartExecutiveJurusan() {
        var executive_ipa = @this.executive_ipa;
        var executive_ips = @this.executive_ips;

        var options = {
            chart: {
                height: 300,
                type: "donut",
            },
            series: [executive_ipa, executive_ips],
            labels: [
                "IPA",
                "IPS",
            ],
            colors: [
                "#000000",
                "#8359A3",
            ],
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 5,
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240,
                    },
                    legend: {
                        show: false,
                    },
                },
            }],
            plotOptions: {
                pie: {
                    donut: {
                        size: '45%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                            }
                        }
                    }
                }
            }
        };
        var chart = new ApexCharts(
            document.querySelector("#pie_chart_executive_jurusan"),
            options
        );
        chart.render();
    }

    function pieChartRegulerACJurusan() {
        var reguler_ac_ipa = @this.reguler_ac_ipa;
        var reguler_ac_ips = @this.reguler_ac_ips;

        var options = {
            chart: {
                height: 300,
                type: "donut",
            },
            series: [reguler_ac_ipa, reguler_ac_ips],
            labels: [
                "IPA",
                "IPS",
            ],
            colors: [
                "#757575",
                "#964b00",
            ],
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 5,
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240,
                    },
                    legend: {
                        show: false,
                    },
                },
            }],
            plotOptions: {
                pie: {
                    donut: {
                        size: '45%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                            }
                        }
                    }
                }
            }
        };
        var chart = new ApexCharts(
            document.querySelector("#pie_chart_reguler_ac_jurusan"),
            options
        );
        chart.render();
    }

    function pieChartNonACJurusan() {
        var non_ac_ipa = @this.non_ac_ipa;
        var non_ac_ips = @this.non_ac_ips;

        var options = {
            chart: {
                height: 300,
                type: "donut",
            },
            series: [non_ac_ipa, non_ac_ips],
            labels: [
                "IPA",
                "IPS",
            ],
            colors: [
                "#FF1493",
                "#00FF00",
            ],
            legend: {
                show: true,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: false,
                fontSize: "14px",
                offsetX: 0,
                offsetY: 5,
            },
            responsive: [{
                breakpoint: 600,
                options: {
                    chart: {
                        height: 240,
                    },
                    legend: {
                        show: false,
                    },
                },
            }],
            plotOptions: {
                pie: {
                    donut: {
                        size: '45%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                            }
                        }
                    }
                }
            }
        };
        var chart = new ApexCharts(
            document.querySelector("#pie_chart_non_ac_jurusan"),
            options
        );
        chart.render();
    }
    document.addEventListener('livewire:load', function() {
        pieChart();
        pieChartExecutiveJurusan();
        pieChartRegulerACJurusan();
        pieChartNonACJurusan();
    });

    document.addEventListener('livewire:update', function() {
        pieChart();
        pieChartExecutiveJurusan();
        pieChartRegulerACJurusan();
        pieChartNonACJurusan();
    })
</script>
@endpush
@endif