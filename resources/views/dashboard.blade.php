<x-app-layout>
    <!-- Dashbaord Stats -->
    <section class="dashboard">
        <div class="container">
            <h1 class="clearfix">Colleges Applications Status </h1>
            <div class="row">
                <div class="col-md-3">
                    <a href="{{ route('applications.index') }}" class="dash-item">
                        <div class="item-head blue-bg">
                            <i class="fa fa-folder-open"></i>
                        </div>
                        <span>{{ $totalApplications }}</span>
                        Total Applications
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('applications.index') }}" class="dash-item">
                        <div class="item-head orange-bg">
                            <i class="fa fa-history"></i>
                        </div>
                        <span>{{ $totalPendingApplications }}</span>
                        Pending  Applications
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="dash-item">
                        <div class="item-head red-bg">
                            <i class="fa fa-arrow-down"></i>
                        </div>
                        <span>{{ $totalReturnedApplications }}</span>
                        Returned Applications
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="dash-item">
                        <div class="item-head green-bg">
                            <i class="fa fa-check"></i>
                        </div>
                        <span>{{ $totalApprovedApplications }}</span>
                        Approved Applications
                    </a>
                </div>
            </div>
        </div>

        <div class="create-app">
            <div class="container">
                <h2 class="clearfix mt-4">Create New Application</h2>
                <div class="row">
                    @foreach($applicationTypes as $row)
                    <div class="col-md-3">
                        <div class="create-app-item">
                            <p>{{$row->name}}</p>
                            <a href="{{route('applications.create') . '?application_type_id=' . ($row->id)}}" target="_blank"><i class="fa fa-plus-circle"></i> Create</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="container">
        <div class="col-12 mt-4">
            <div class="dash-chart">
                <figure class="highcharts-figure">
                    <!--<div id="container"></div>-->
                </figure>
            </div>
        </div>
    </div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'PHED Colleges Stats Graph'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: ['1750', '1800', '1850', '1900', '1950', '1999', '2050'],
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Billions'
                },
                labels: {
                    formatter: function () {
                        return this.value / 1000;
                    }
                }
            },
            tooltip: {
                split: true,
                valueSuffix: ' millions'
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },
            series: [{
                    name: 'Total',
                    data: [502, 635, 809, 947, 1402, 3634, 5268]
                }, {
                    name: 'Pending',
                    data: [106, 107, 111, 133, 221, 767, 1766]
                }, {
                    name: 'Returned',
                    data: [163, 203, 276, 408, 547, 729, 628]
                }, {
                    name: 'Approved',
                    data: [18, 31, 54, 156, 339, 818, 1201]
                }]
        });
    </script>
</x-app-layout>
