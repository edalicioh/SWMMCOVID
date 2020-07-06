<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Top Navigation</title>

    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        #chartdiv {
            width: 100%;
            height: 600px;
        }

        #chartdiv2 {
            width: 100%;
            height: 500px;
        }

        #chartdiv3 {
            width: 100%;
            height: 500px;
        }

        #chartdiv4 {
            width: 100%;
            height: 500px;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="index3.html" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">Contact</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item">Some action </a></li>
                                <li><a href="#" class="dropdown-item">Some other action</a></li>

                                <li class="dropdown-divider"></li>

                                <!-- Level two dropdown-->
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"
                                        class="dropdown-item dropdown-toggle">Hover for action</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                                        </li>

                                        <!-- Level three dropdown-->
                                        <li class="dropdown-submenu">
                                            <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"
                                                class="dropdown-item dropdown-toggle">level 2</a>
                                            <ul aria-labelledby="dropdownSubMenu3"
                                                class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                                <li><a href="#" class="dropdown-item">3rd level</a></li>
                                            </ul>
                                        </li>
                                        <!-- End Level three -->

                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                        <li><a href="#" class="dropdown-item">level 2</a></li>
                                    </ul>
                                </li>
                                <!-- End Level two -->
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md">
                            <div class="card">
                                <div class="card-body">
                                    <table id="example" class="table"></table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div id="chartdiv"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div id="chartdiv2"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>

            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"> Top Navigation <small>Example 3.0</small></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <!-- Main content -->
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div id="chartdiv3"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div id="chartdiv4"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content -->
            </div>

            <footer class="main-footer">
                <!-- To the right -->
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <!-- Default to the left -->
                <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
                reserved.
            </footer>
        </div>

        <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
        <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://adminlte.io/themes/v3/dist/js/adminlte.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://www.amcharts.com/lib/4/core.js"></script>
        <script src="https://www.amcharts.com/lib/4/charts.js"></script>
        <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

        <script>


            am4core.useTheme(am4themes_animated);



            fetch("../public/api/map/full")
                .then(function(response){
                    response.json().then(function(data){
                        console.log(data);


                    var t = $('#example').DataTable({
                        paging: false,
                        info: false,
                        data: data.data.locais,
                        columns: [
                            { data: 'name', title: 'Bairro' },
                            { data: 'quantidade', title: "quantidade" },

                        ],
                        columnDefs: [
                            { width: '10%', targets: 1 },

                        ],
                        "order": [[1, "desc"]],
                        fixedColumns: true
                    });

                    var chart = am4core.create("chartdiv", am4charts.PieChart);

                    // Add data
                    chart.data = data.data.locais
                    // Add and configure Series
                    var pieSeries = chart.series.push(new am4charts.PieSeries());
                    pieSeries.dataFields.value = "quantidade";
                    pieSeries.dataFields.category = "name";
                    pieSeries.innerRadius = am4core.percent(50);

                    chart.legend = new am4charts.Legend();
                    chart.legend.position = "right";
                    chart.legend.valueLabels.template.align = "right";
                    chart.legend.valueLabels.template.textAlign = "end";
                    chart.legend.labels.template.text = "{name}  ({value})";
                    chart.responsive.enabled = true;
                    chart.legend.scrollable = true;

                    chart.responsive.rules.push({
                        relevant: function (target) {
                            if (target.pixelWidth <= 600) {
                                return true;
                            }
                            return false;
                        },
                        state: function (target, stateId) {
                            if (target instanceof am4charts.PieSeries) {
                                var state = target.states.create(stateId);
                                chart.legend.position = 'top';
                                var labelState = target.labels.template.states.create(stateId);
                                labelState.properties.disabled = true;

                                var tickState = target.ticks.template.states.create(stateId);
                                tickState.properties.disabled = true;
                                return state;
                            }

                            return null;
                        }
                    });


                })
            })

            fetch("../public/api/chart/district")
                .then(function(response){
                    response.json().then(function(data){

                        console.log(data);


                        am4core.ready(function () {

                            var chart = am4core.create("chartdiv2", am4charts.XYChart);

                            chart.data = data



                            chart.legend = new am4charts.Legend()
                            chart.legend.position = 'top'
                            chart.legend.paddingBottom = 20

                            var xAxis = chart.xAxes.push(new am4charts.CategoryAxis())
                            xAxis.dataFields.category = 'name'


                            var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
                            yAxis.min = 0;

                            function createSeries(value, name) {
                                var series = chart.series.push(new am4charts.ColumnSeries())
                                series.dataFields.valueY = value
                                series.dataFields.categoryX = 'name'
                                series.tooltipText = "{valueY.value}"
                                series.name = name

                                series.events.on("hidden", arrangeColumns);
                                series.events.on("shown", arrangeColumns);


                                return series;
                            }


                            chart.colors.list = [

                                am4core.color("#7ED321"),
                                am4core.color("#FC5F2A"),
                                am4core.color("#C9B600"),
                                am4core.color("#FF0000"),
                                am4core.color("#00AE45"),
                                am4core.color("#000000")
                            ];


                            createSeries('0', 'Não detectável (negativo)');
                            createSeries('2', 'Tratamento Uti');
                            createSeries('3', 'Tratamento Enfermaria');
                            createSeries('4', 'Tratamento Monitoramento domiciliar');
                            createSeries('5', 'Recuperado');
                            createSeries('6', 'Óbito');
                            chart.scrollbarX = new am4core.Scrollbar();
                            chart.responsive.enabled = true;
                            chart.legend.scrollable = true;
                            series.columns.template.events.once("inited", function(event){
                                event.target.fill = chart.colors.getIndex(event.target.dataItem.index);
                            });

                            function arrangeColumns() {

                                var series = chart.series.getIndex(0);

                                var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
                                if (series.dataItems.length > 1) {
                                    var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                                    var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                                    var delta = ((x1 - x0) / chart.series.length) * w;
                                    if (am4core.isNumber(delta)) {
                                        var middle = chart.series.length / 3;

                                        var newIndex = 0;
                                        chart.series.each(function (series) {
                                            if (!series.isHidden && !series.isHiding) {
                                                series.dummyData = newIndex;
                                                newIndex++;
                                            }
                                            else {
                                                series.dummyData = chart.series.indexOf(series);
                                            }
                                        })
                                        var visibleCount = newIndex;
                                        var newMiddle = visibleCount / 3;

                                        chart.series.each(function (series) {
                                            var trueIndex = chart.series.indexOf(series);
                                            var newIndex = series.dummyData;

                                            var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                                            series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                                            series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                                        })
                                    }
                                }
                            }

                        });

                })
            })

            fetch("../public/api/chart/gender/M")
                .then(function(response){
                    response.json().then(function(data){
                    am4core.ready(function () {

                        var man = "M53.5,476c0,14,6.833,21,20.5,21s20.5-7,20.5-21V287h21v189c0,14,6.834,21,20.5,21 c13.667,0,20.5-7,20.5-21V154h10v116c0,7.334,2.5,12.667,7.5,16s10.167,3.333,15.5,0s8-8.667,8-16V145c0-13.334-4.5-23.667-13.5-31 s-21.5-11-37.5-11h-82c-15.333,0-27.833,3.333-37.5,10s-14.5,17-14.5,31v133c0,6,2.667,10.333,8,13s10.5,2.667,15.5,0s7.5-7,7.5-13 V154h10V476 M61.5,42.5c0,11.667,4.167,21.667,12.5,30S92.333,85,104,85s21.667-4.167,30-12.5S146.5,54,146.5,42 c0-11.335-4.167-21.168-12.5-29.5C125.667,4.167,115.667,0,104,0S82.333,4.167,74,12.5S61.5,30.833,61.5,42.5z"

                        var chart = am4core.create("chartdiv3", am4charts.SlicedChart);
                        chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                        chart.paddingLeft = 150;

                        chart.data = data;

                        var series = chart.series.push(new am4charts.PictorialStackedSeries());
                        series.dataFields.value = "value";
                        series.dataFields.category = "name";
                        series.alignLabels = true;
                        // this makes only A label to be visible
                        series.labels.template.propertyFields.disabled = "disabled";
                        series.ticks.template.propertyFields.disabled = "disabled";


                        series.maskSprite.path = man;
                        series.ticks.template.locationX = 1;
                        series.ticks.template.locationY = 0;

                        series.labelsContainer.width = 100;

                        chart.legend = new am4charts.Legend();
                        chart.legend.position = "top";
                        chart.legend.paddingRight = 160;
                        chart.legend.paddingBottom = 40;
                        let marker = chart.legend.markers.template.children.getIndex(0);
                        chart.legend.markers.template.width = 40;
                        chart.legend.markers.template.height = 40;
                        marker.cornerRadius(20, 20, 20, 20);

                        });
                    })
                })
            fetch("../public/api/chart/gender/F")
                .then(function(response){
                    response.json().then(function(data){
                        am4core.ready(function () {

                                var iconPath = "m 384.977,276.115 c -0.33,-0.902 -33.149,-90.694 -47.603,-132.749 -9.325,-27.136 -24.962,-40.895 -46.474,-40.895 -29.934,0 -39.899,0 -69.8,0 -21.512,0 -37.149,13.759 -46.474,40.895 -14.452,42.055 -47.272,131.848 -47.603,132.749 -3.812,10.425 1.549,21.968 11.975,25.779 10.425,3.812 21.968,-1.551 25.779,-11.975 0.273,-0.748 22.776,-62.314 38.824,-107.645 1.435,4.712 4.37,8.758 8.233,11.627 l 0.048,29.451 -34.573,87.18 c -1.885,4.755 0.875,10.067 5.834,11.259 5.161,1.24 11.996,2.93 19.41,4.782 V 487.88 c 0,13.321 10.799,24.12 24.12,24.12 13.321,0 24.12,-10.799 24.12,-24.12 V 337.975 c 3.464,0.307 6.948,0.305 10.413,-0.006 V 487.88 c 0,13.321 10.799,24.12 24.12,24.12 13.321,0 24.12,-10.799 24.12,-24.12 V 326.551 c 7.407,-1.852 14.236,-3.538 19.398,-4.776 4.924,-1.18 7.731,-6.492 5.84,-11.261 l -34.567,-87.163 0.048,-29.451 c 3.864,-2.868 6.797,-6.914 8.233,-11.627 16.047,45.331 38.551,106.897 38.824,107.645 3.812,10.426 15.354,15.787 25.779,11.975 10.427,-3.81 15.788,-15.353 11.976,-25.778 z M 299.898,43.897999 A 43.897999,43.897999 0 0 1 256,87.795998 43.897999,43.897999 0 0 1 212.102,43.897999 43.897999,43.897999 0 0 1 256,0 43.897999,43.897999 0 0 1 299.898,43.897999 Z"

                                var chart = am4core.create("chartdiv4", am4charts.SlicedChart);
                                chart.hiddenState.properties.opacity = 0; // this makes initial fade in effect
                                chart.paddingLeft = 150;

                                chart.data = data;

                                var series = chart.series.push(new am4charts.PictorialStackedSeries());
                                series.dataFields.value = "value";
                                series.dataFields.category = "name";
                                series.alignLabels = true;
                                // this makes only A label to be visible
                                series.labels.template.propertyFields.disabled = "disabled";
                                series.ticks.template.propertyFields.disabled = "disabled";


                                series.maskSprite.path = iconPath;
                                series.ticks.template.locationX = 1;
                                series.ticks.template.locationY = 0;

                                series.labelsContainer.width = 100;

                                chart.legend = new am4charts.Legend();
                                chart.legend.position = "top";
                                chart.legend.paddingRight = 160;
                                chart.legend.paddingBottom = 40;
                                let marker = chart.legend.markers.template.children.getIndex(0);
                                chart.legend.markers.template.width = 40;
                                chart.legend.markers.template.height = 40;
                                marker.cornerRadius(20, 20, 20, 20);

                                });
                    })
            })


    </script>
</body>

</html>
