<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!-- Styles -->
<style>
    #chartdiv {
      width: 100%;
      height: 600px;
    }

    </style>

    <!-- Resources -->
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/material.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>

    <!-- Chart code -->
    <script>

    fetch("../public/api/map/full")
    .then(function(response){
    response.json().then(function(data){
        console.log(data.data.locais);
        am4core.ready(function() {

            // Themes begin
            am4core.useTheme(am4themes_material);
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("chartdiv", am4charts.PieChart3D);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in


            chart.data = data.data.locais;

            var series = chart.series.push(new am4charts.PieSeries3D());
            series.dataFields.value = "quantidade";
            series.dataFields.category = "name";

            chart.legend = new am4charts.Legend();
            chart.legend.position = "right";
            chart.legend.maxWidth = 200;
            chart.legend.scrollable = true;

            chart.responsive.enabled = true;
            chart.responsive.rules.push({
                relevant: function(target) {
                    if (target.pixelWidth <= 600) {
                    return true;
                    }
                    return false;
                },
                state: function(target, stateId) {
                    if (target instanceof am4charts.PieSeries3D) {
                        var state = target.states.create(stateId);

                        var labelState = target.labels.template.states.create(stateId);
                        labelState.properties.disabled = true;

                        var tickState = target.ticks.template.states.create(stateId);
                        tickState.properties.disabled = true;
                        return state;
                    }

                    return null;
                }
            });

        });
    })
    .catch(function(err){
        console.error('Failed retrieving information', err);
    });


    </script>


<body>
    <div id="chartdiv"></div>
</body>
</html>
