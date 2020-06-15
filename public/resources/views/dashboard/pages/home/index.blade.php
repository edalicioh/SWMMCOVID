{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
@include('dashboard.pages.home.components._infoBox')
@include('dashboard.pages.home.components._chart')

@stop


@section('js')
<script>
var ctx = document.getElementById('myChart');

var myLineChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [
            {
                label: '# of Votes',
                fill: false,
                backgroundColor: '#00f',
				borderColor: '#00f',
                data: [12, 19, 3, 5, 2, 3],

            }, 
            {
                label: '# oss Votes',
                fill: false,
                backgroundColor: '#f00',
				borderColor: '#f00',
                data: [11, 15, 13, 5, 12, 3],
            }
        ]
    },
    options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
});
</script>
@stop
