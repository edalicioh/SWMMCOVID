<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covid-19</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<!-- Styles -->
<style>
body{
    background: rgba(#000000, #000000, #000000, .2)
}

.button{
    position: absolute;
    left: 10px;
    top: 10px;

 }
 #chartdiv{
        height: 80vh;
    }

 .title {
    position: absolute;
    top: 20vh;
    left: 10%;
    font-size: 50px;
    font-weight: bold;
    color: #fff;
}
.subTitle {
    position: absolute;
    top: 45vh;
    left: 10%;
    font-size: 30px;
    font-weight: bold;
    color: #fff;
}
.footer {
    width: 100%;
}

.leg{
    display: flex ;
    align-items: center;
    justify-content: center;
}
.legend-item{
    padding: 10px 0 10px 0;
    margin: 2px;
}


@media (max-width: 768px) {
    .col-md-5 {
        position: relative;
        width: 33%;
    }
    .title {
        position: absolute;
        top: 10vh;
        left: 5%;
        font-size: 25px;
        font-weight: bold;
        color: #fff;
        text-align: center;
    }

    .subTitle {
        display: none;
    }

    #legend{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }
    .legend-item{
        margin: 2px;
        text-align: center;
    }
    .leg-icon{
        display: none
    }
    .text-ti {
        font-size: 15px;
    }
    #chartdiv{
        height: 350px;
    }
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
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart3D);

// Add data
chart.data = data.data.locais

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries3D());
pieSeries.dataFields.value = "quantidade";
pieSeries.dataFields.category = "name";
pieSeries.labels.template.disabled = true;

chart.radius = am4core.percent(90);

// Create custom legend
chart.events.on("ready", function (event) {
  // populate our custom legend when chart renders
  chart.customLegend = document.getElementById("legend");
  pieSeries.dataItems.each(function (row, i) {
    var color = chart.colors.getIndex(i);
    var percent = Math.round(row.values.value.percent * 100) / 100;
    var value = row.value;
    legend.innerHTML +=
      `<div class="legend-item col-md-5 text-center" id="legend-item-${i}" style="color: #000; background:${color}">
            <div class="legend-marker px-2">
               ${row.category}
            </div>
            <div class="legend-value px-2">
                ${value} | ${percent}%
            </div>
        </div>
        `;
  });
});

function toggleSlice(item) {
  var slice = pieSeries.dataItems.getIndex(item);
  if (slice.visible) {
    slice.hide();
  } else {
    slice.show();
  }
}

function hoverSlice(item) {
  var slice = pieSeries.slices.getIndex(item);
  slice.isHover = true;
}

function blurSlice(item) {
  var slice = pieSeries.slices.getIndex(item);
  slice.isHover = false;
}


        })

    })
    .catch(function(err){
        console.error('Failed retrieving information', err);
    });


    </script>


<body>
    <div class="row">
        <a class=" btn text-white px-2 shadow-lg  rounded button"  href="{{ url('../') }}">Voltar</a>
            <div class="col-md-7">
                <h2 class="title">NÚMERO DE CASOS POSITIVOS POR BAIRROS NO MUNICÍPIO DE CAMBORIÚ ACUMULADO ATÉ A PRESENTE DATA.</h2>
            </div>
        <img src="{{ asset('../public/img/banner-covid-19.jpg') }}" style="width: 100%; max-height: 100vh    ;" alt="">
    </div>
    <div class="row">
        <div id="chartdiv" class="col-md-7"></div>
        <div class="col-md leg">
            <div id="legend" class="row"></div>
        </div>
    </div>
    <div class="row">
        <img class="footer mt-3" src="{{ asset('../public/img/footer-covid-19.jpg') }}" alt="">
    </div>


</body>
</html>
