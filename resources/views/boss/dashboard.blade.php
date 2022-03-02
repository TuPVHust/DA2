@extends('layouts.boss')
@section('title')
    AdminLTE 3 | Dashboard
@endsection
@section('css')
    {{-- datatables --}}
    {{-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('bossUI') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" /> --}}
@endsection
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('boss.dashboard') }}">Home</a></li>
        <li class="breadcrumb-item active">DashBoard</li>
    </ol>
@endsection
@section('content')
    @livewire('dash-board',['thisYear' => $thisYear, 'topDrivers' => $topDrivers,])
@endsection

@section('js')
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuRhWjgbSc-xuAY5C8oFb5M1vACc1LhuU&callback=initMap">
    </script> --}}
    {{-- <!-- ChartJS --> --}}
    <script src="{{ url('bossUI') }}/plugins/chart.js/Chart.min.js"></script>
    <script>
        $(function() {
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.

            // var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            //  data for cost char
            var areaCostChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                    'October', 'November', 'December'
                ],
                // labels: {{ $timeInterval }},
                datasets: [{
                    label: 'Chi phí',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointRadius: false,
                    pointColor: '#3b8bba',
                    pointStrokeColor: 'rgba(60,141,188,1)',
                    pointHighlightFill: '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data: {{ $costForMonth }}
                }, ]
            }
            // end data for cost char

            // Data for revenue chart
            var areaChartData = {
                // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                //     'October', 'November', 'December'
                // ],
                labels: {!! $timeInterval !!},
                datasets: [{
                        label: 'Doanh thu',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: {{ $revenueForMonth }}
                    },
                    {
                        label: 'Thực thu',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: {{ $actualRevenueForMonth }}
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false,
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.

            // new Chart(areaChartCanvas, {
            //     type: 'line',
            //     data: areaChartData,
            //     options: areaChartOptions
            // })

            //-------------
            //- LINE CHART -
            //--------------
            // var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            // var lineChartOptions = $.extend(true, {}, areaChartOptions)
            // var lineChartData = $.extend(true, {}, areaCostChartData)
            // lineChartData.datasets[0].fill = false;
            // lineChartData.datasets[1].fill = false;
            // lineChartOptions.datasetFill = false

            // var lineChart = new Chart(lineChartCanvas, {
            //     type: 'line',
            //     data: lineChartData,
            //     options: lineChartOptions
            // })

            //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            // const test = {{ $topCategories_name }}
            // alert(typeof test);
            //labels = JSON.parse({{ $topCategories_value }})
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                // labels: [
                //     'Chrome',
                //     'IE',
                //     'FireFox',
                //     'Safari',
                //     'Opera',
                //     'Navigator',
                // ],

                labels: {!! $topCategories_name !!},
                datasets: [{
                    data: {{ $topCategories_value }},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            //var pieData = donutData;
            var pieData = {
                labels: {!! $topCosts_name !!},
                datasets: [{
                    data: {{ $topCosts_value }},
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
                }]
            }
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            new Chart(pieChartCanvas, {
                type: 'pie',
                data: pieData,
                options: pieOptions
            })

            //-------------
            //- BAR CHART FOR REVENUE AND ACTUAL REVENUE -
            //-------------
            var barChartCanvasRevenue = $('#barChartRevenue').get(0).getContext('2d')
            var barChartDataRevenue = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartDataRevenue.datasets[0] = temp1
            barChartDataRevenue.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvasRevenue, {
                type: 'bar',
                data: barChartDataRevenue,
                options: barChartOptions
            })


            //-------------
            //- BAR CHART FOR COST AND ACTUAL COST -
            //-------------
            var barChartCanvas = $('#barChartCost').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaCostChartData)
            var temp0 = areaCostChartData.datasets[0]
            //var temp1 = areaCostChartData.datasets[1]
            barChartData.datasets[0] = temp0
            //barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
            // var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            // var stackedBarChartData = $.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            // new Chart(stackedBarChartCanvas, {
            //     type: 'bar',
            //     data: stackedBarChartData,
            //     options: stackedBarChartOptions
            // })
        })
    </script>
    <!-- DataTables  & Plugins -->
    {{-- <script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script> --}}
    <!-- DataTables  & Plugins -->
    <script src="{{ url('bossUI') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('bossUI') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                paging: false,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                select: true
            })
        });
    </script>
@endsection
