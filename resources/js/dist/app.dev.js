"use strict";

require("./bootstrap");

var path = require("path");

var _require = require("./dados"),
    dados = _require.dados;

var divLoad = document.getElementById("load");
divLoad.style.display = "flex";
var mymap;
var cities = "";
var districts = "";
var camboriu;
var store;
axios.get("public/api/map/full").then(function (response) {
  cities = response.data.cities;
  console.log(cities);
  districts = response.data.districts;
  camboriu = cities[0].city_coordinates.split(",");
  var quantidade = response.data.data.quantidade;
  mymap = L.map("mapid", {
    zoomControl: false
  }).setView(camboriu, 13);
  L.control.zoom({
    position: "bottomright"
  }).addTo(mymap);
  L.tileLayer("https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZWRhbGljaW8iLCJhIjoiY2thZTVxb3hoMGdldTJybGR0bmRhMzgxeiJ9.2YVn5NR7K2g-mOF8yB4Y_Q", {
    attribution: ' &copy; <a href="http://www.camboriu.ifc.edu.br/">IFC - Campus Camboriú</a>',
    maxZoom: 17,
    id: "mapbox/streets-v11",
    tileSize: 512,
    zoomOffset: -1,
    accessToken: "pk.eyJ1IjoiZWRhbGljaW8iLCJhIjoiY2thZTVxb3hoMGdldTJybGR0bmRhMzgxeiJ9.2YVn5NR7K2g-mOF8yB4Y_Q"
  }).addTo(mymap);
  L.Control.Watermark = L.Control.extend({
    onAdd: function onAdd(mymap) {
      var img = L.DomUtil.create("img");
      img.src = "public/img/logoIFC.png";
      img.style.width = "150px";
      return img;
    },
    onRemove: function onRemove(mymap) {// Nothing to do here
    }
  });

  L.control.watermark = function (opts) {
    return new L.Control.Watermark(opts);
  };

  L.control.watermark({
    position: "bottomleft"
  }).addTo(mymap);
  getCoordinates(cities[0].city_name.toLowerCase(), cities[0]);
  store = [response.data.data.quantidade, cities[0].city_name];
  listInfo(response.data.data.quantidade, cities[0].city_name);
  map(response.data.data.locais);
  console.log("<- <-");
  OptDistrict(districts, cities);
  addhospital();
  divLoad.style.display = "none";
})["catch"](function (error) {
  console.log(error);
});

var map = function map(position) {
  position.map(function (e) {
    if (e.position != null) {
      L.circle(e.position.split(","), {
        color: "#f00",
        fillOpacity: 0.3,
        radius: 200
      }).bindPopup("<b>".concat(e.name, "</b>")).addTo(mymap);
    }
  });
};

document.getElementById("search-district").addEventListener("submit", function (e) {
  e.preventDefault();
  divLoad.style.display = "flex";
  var district_id = document.getElementById("select-search").value;
  axios.get("public/api/map/".concat(district_id)).then(function (response) {
    if (isEmpty(response.data.data.locais)) {
      console.log(response.data.data.locais);
      response.data.data.locais.map(function (e) {
        mymap.flyTo(e.position.split(","), 15);
      });
      listInfo(response.data.data.quantidade, response.data.data.locais[0].name);
      divLoad.style.display = "none";
    } else {
      listInfo(store[0], store[1]);
      divLoad.style.display = "none";
      mymap.flyTo(camboriu, 13);
    }
  });
});

function isEmpty(obj) {
  for (var prop in obj) {
    if (obj.hasOwnProperty(prop)) return true;
  }

  return false;
}

document.getElementById("menu-info").addEventListener("click", function (e) {
  e.preventDefault();
  var infoBox = document.getElementById("info-box");

  if (infoBox.style.display === "block") {
    infoBox.style.display = "none";
  } else {
    infoBox.style.display = "block";
  }
});

function addhospital() {
  dados["hospital"].map(function (e) {
    L.marker(e.local.split(","), {
      icon: L.AwesomeMarkers.icon({
        icon: "hospital-symbol",
        prefix: "fa",
        markerColor: "red"
      })
    }).bindPopup("<b>".concat(e.nome, ".</b>")).addTo(mymap);
  });
}

function OptDistrict(districts, cities) {
  console.log('da->');
  var html = '<option selected disabled>Buscar por Bairro</option><option value="-0" >Ver Todos</option>';
  cities.map(function (city) {
    html += "<optgroup label=\"".concat(city.city_name, "\">");
    districts.map(function (e) {
      if (e.city_id === city.id) {
        html += "<option value=\"".concat(e.id, "\">").concat(e.district_name, "</option>");
      }
    });
  });
  document.getElementById("select-search").innerHTML = html;
}

function listInfo(infos, name) {
  var tratamento = 0;
  document.getElementById("recuperado").innerHTML = 0;
  document.getElementById("obito").innerHTML = 0;
  document.getElementById("positivo").innerHTML = 0;
  document.getElementById("tratamento").innerHTML = 0;
  infos.map(function (e) {
    switch (e.tipo) {
      case "Recuperado":
        document.getElementById("recuperado").innerHTML = e.quantidade;
        break;

      case "Óbito":
        document.getElementById("obito").innerHTML = e.quantidade;
        break;

      case "Positivo":
        document.getElementById("positivo").innerHTML = e.quantidade;
        break;

      case "Tratamento":
        document.getElementById("tratamento").innerHTML = e.quantidade;
        tratamento += e.quantidade;
        break;
    }
  });
  console.log(tratamento);
  document.getElementById('title-info').innerHTML = name;
  document.getElementById("tratamento").innerHTML = tratamento;
}

function getCoordinates(name) {
  var style = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  var dados = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : null;
  //axios.get(`public/js/camboriú.geojson`)
  axios.get("public/js/Mapa_1.geojson").then(function (res) {
    console.log(res.data);
    L.geoJson(res.data).addTo(mymap);
  })["catch"](function (error) {
    console.log(error.response);
  });
}

function onEachFeature(feature, layer) {
  if (feature.data.district_name) {
    layer.bindPopup(feature.data.district_name);
  } else {
    layer.bindPopup(feature.data.city_name);
  }

  layer.on({
    click: zoomToFeature
  });
}

function zoomToFeature(e) {
  console.log(e);
  var district_id = e.target.feature.data.id;
  axios.get("public/api/map/".concat(district_id)).then(function (response) {
    if (isEmpty(response.data.data.locais)) {
      console.log(response.data.data.locais);
      response.data.data.locais.map(function (e) {
        mymap.flyTo(e.position.split(","), 15);
      });
      listInfo(response.data.data.quantidade, response.data.data.locais[0].name);
      mymap.fitBounds(e.target.getBounds());
    } else {
      listInfo(store[0], store[1]);
      mymap.flyTo(camboriu, 13);
      mymap.fitBounds(e.target.getBounds());
    }
  });
}

function pointToLayer(feature, latlng) {
  return L.circleMarker(feature.data, {
    radius: 8,
    fillColor: "#ff7800",
    color: "#000",
    weight: 1,
    opacity: 1,
    fillOpacity: 0.8
  });
}