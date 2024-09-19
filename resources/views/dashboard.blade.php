@extends('Layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/billboard.min.css') }}" /> 
<script src="{{ asset('js/d3w4.min.js') }}"></script>
<script src="{{ asset('js/billboard.min.js') }}"></script>
<script src="{{ asset('js/apexcharts.min.js') }}"></script>

<form class="container-date" action="{{ route('dashboard') }}" method="GET">
    <div>
        @if($showAll)
            <h4>Dashboard set for All Time</h4>
        @else
            <h4>Dashboard Set for {{ $month }}/{{ $year }}</h4>
        @endif
    </div>
    <div>

        <select class="form-select" name="month" id="month" required>
            <option value="01" {{ date('m') == '01' ? 'selected' : '' }}>January</option>
            <option value="02" {{ date('m') == '02' ? 'selected' : '' }}>February</option>
            <option value="03" {{ date('m') == '03' ? 'selected' : '' }}>March</option>
            <option value="04" {{ date('m') == '04' ? 'selected' : '' }}>April</option>
            <option value="05" {{ date('m') == '05' ? 'selected' : '' }}>May</option>
            <option value="06" {{ date('m') == '06' ? 'selected' : '' }}>June</option>
            <option value="07" {{ date('m') == '07' ? 'selected' : '' }}>July</option>
            <option value="08" {{ date('m') == '08' ? 'selected' : '' }}>August</option>
            <option value="09" {{ date('m') == '09' ? 'selected' : '' }}>September</option>
            <option value="10" {{ date('m') == '10' ? 'selected' : '' }}>October</option>
            <option value="11" {{ date('m') == '11' ? 'selected' : '' }}>November</option>
            <option value="12" {{ date('m') == '12' ? 'selected' : '' }}>December</option>
        </select>
        <input class="form-control" type="number" name="year" id="year" value="{{ date('Y') }}" required min="2000"
            max="{{ date('Y') }}">
        <button class="btn btn-outline-primary" type="submit">Filter</button>
        <!-- Show All Button -->
        <button class="btn-outline-secondary btn" type="submit" name="show_all" value="1">Show All</button>
    </div>
</form>


<div class="details ">
    <!-- <div class="box">
        <h6>Total Devices :</h6>
        <div>
            <span>{{ $deviceCount }}</span>
            <p>devices</p>
        </div>
    </div> -->
    <div class="box">
        <h6>Total Maintenances :</h6>
        <div>
            <span>{{ $maintenances }}</span>
            <p>Maintenances</p>
        </div>
    </div>
    <div class="box">
        <h6>Total Credit Additions :</h6>
        <div>
            <span>{{ $totalAddition }}</span>
            <p>EGP</p>
        </div>
    </div>
    <div class="box">
        <h6>Total Spent :</h6>
        <div>
            <span>{{ $totalDeductionNum }}</span>
            <p>EGP</p>
        </div>
    </div>
    <div class="box">
        <div>
            <div id="pieChart"></div>
        </div>
    </div>
</div>

<div class="details">
    <div id="chart" class="w-50"></div>
    <div id="treemapChart_1" class="m-5 w-50"></div>
</div>



<div class="dashboard-view">

    <div class="left">
        <span>Computers :</span>
        <span>{{$pcs}} PCs</span>
        <br>
        <span>Printers :</span>
        <span>{{$printers}} Printers</span>
        <br>
        <span>VMT :</span>
        <span>{{$VMTs}} Devices</span>
        <br>
        <span>PDA :</span>
        <span>{{$PDAs}} Devices</span>
        <br>
        <span>RDT :</span>
        <span>{{$RDTs}} Devices</span>
        <br>
        <span>Total Registered Devices :</span>
        <span>{{$deviceCount}} Devices</span>
        <br>
        <span>Total Registered Maintenances :</span>
        <span>{{$maintenances}} Maintenance</span>
    </div>
    <div class="right">
        <div id="donut-chart"></div>
    </div>
</div>
<hr>
<br>

<footer>
    <p>
      Powered by IT Team - Dekheila
    </p>
  </footer>



<!-- Include the ApexCharts library -->




<script>
    // ApexCharts
    // A + B = 100% , A = 100% - B

    var totalRemain = {{$totalAddition}} - {{ $totalDeductionNum }};
    var options = {
        chart: {
            type: 'pie'
        },
        series: [ {{$totalAddition - $totalDeductionNum}}, {{$totalDeductionNum}} ], // Data for the chart
        labels: ['Addition', 'Spent'], // Labels for the chart
        // colors: ['#00E396', '#FF4560'], // Customize colors for the slices
        colors: ['#2ca02c', '#d62728'], // Customize colors for the slices
        tooltip: {
            enabled: false,
        }
    };

    // Render the chart
    var chart = new ApexCharts(document.querySelector("#pieChart"), options);
    chart.render();
    // Prepare the chart options
    var options = {
        chart: {
            height: 350,
            type: "bar",
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#FF1654", "#247BA0"],
        series: [
            {
                name: "Total Devices",
                data: [{{$VSPLAN}},
      {{$YRPLAN}},
      {{$CustSRV}},
      {{$BillSRV}},
      {{$Resrv}},
                    {{$Gates}}
                ]
            }
        ],
        stroke: {
            width: [4, 4]
        },
        plotOptions: {
            bar: {
                columnWidth: "20%"
            }
        },
        xaxis: {
            categories: ['Vessel Planner', 'Yard Planner', 'Customer Service', 'Billing', 'Reservations', 'Gates']
        }

    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();



    let chartOld = bb.generate({
        data: {
            columns: [
                ["Computers", {{$pcs}}],
                ["Printers", {{$printers}}],
                ["VMT", {{$VMTs}}],
                ["PDA", {{$PDAs}}],
                ["RDT", {{$RDTs}}],
                ["Maintenances", {{$maintenances}}],
            ],
            type: "donut",
            onclick: function (d, i) {
                console.log("onclick", d, i);
            },
            onover: function (d, i) {
                console.log("onover", d, i);
            },
            onout: function (d, i) {
                console.log("onout", d, i);
            },
        },
        donut: {
            title: '{{$deviceCount}} Devices',
        },
        bindto: "#donut-chart",
    });



    // chart
    var chartOldTow = bb.generate({
        title: {
            text: "Devices"
        },
        padding: {
            top: 10,
            bottom: 15
        },
        data: {
            columns: [
                ["Vessel Planning", {{$VSPLAN}}],
                ["Yard Plannig", {{$YRPLAN}}],
                ["Customer Services", {{$CustSRV}}],
                ["Billing", {{$BillSRV}}],
                ["Reservations", {{$Resrv}}],
                ['Gates',{{$Gates}}]
            ],
            type: "treemap", // for ESM specify as: treemap()
            labels: {
                colors: "#fff"
            }
        },
        treemap: {
            label: {
                threshold: 0.03
            }
        },
        bindto: "#treemapChart_1"
    });





</script>




@endsection