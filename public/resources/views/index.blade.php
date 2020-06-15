<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/virus.png">
    <title>Auto Proteção Social</title>
    <link rel="stylesheet" href="public/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="public/css/leaflet.awesome-markers.css">
   <link href="public/css/app.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="background-color: transparent !important ;" >
    <button type="button" class="btn btn-light" id="menu-info"><i class="fas fa-bars"></i></button>
    <form  id="search-district" class="col-8 col-md-3 mr-auto">
    <div class="input-group" >
        <select class="custom-select" id="select-search"></select>
    <div class="input-group-append">
        <button class="btn btn-info" type="submit">ir</button>
    </div>
    </div>
    </form>
    @if (env('APP_ENV')!='Production')
<ul class="navbar-nav ml-auto">
    <li class="nav-item">
        <a class=" btn btn-success px-2 shadow-lg  rounded"  href="/login">Login</a>
      </li>
</ul>
@endif
</nav>
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div id="info-box" class="shadow-lg">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center " id="title-info" ></h2>
                        <ul class="list-group list-group-flush " id="info-list"></ul>
                    </div>
                    <a href="http://www.camboriu.ifc.edu.br/autoprotecao-social/">
                        <img src="public/img/Banner-autoproteção-social.png"  class="card-img-top" >
                    </a>
                </div>
            </div>
            <div id="mapid"></div>

        </div>
            <div id="load" >
                <i class="fas fa-virus" id="virus-load"></i>
            </div>



    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="public/js/leaflet.awesome-markers.min.js"></script>
   <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
   <script src="public/js/app.js" defer></script>
</body>

</html>
