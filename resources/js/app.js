require('./bootstrap');
const { dados } = require('./dados')
const divLoad = document.getElementById('load')
divLoad.style.display = "flex"

const STATUS = [
    {
        name: 'Não detectável (negativo)',
        color: '#E85720',
        icon: 'fa-temperature-high',
    },
    {
        name: 'Positivo',
        color: '#E21E26',
        icon: 'fa-check',
    },
    {
        name: 'Tratamento Uti',
        color: '#BF3646',
        icon: 'fa-virus',
    },
    {
        name: 'Tratamento Enfermaria',
        color: '#BF3646',
        icon: 'fa-virus',
    },
    {
        name: 'Tratamento Monitoramento domiciliar',
        color: '#BF3646',
        icon: 'fa-virus',
    },
    {
        name: 'Recuperado',
        color: '#008F5A',
        icon: 'fa-smile',
    },
    {
        name: 'Óbito',
        color: 'fa-cross',
        icon: '#2B2B29',
    },
    {
        name: "Aguardando Resultado",
        color: '#E85720',
        icon: 'fa-temperature-high',

    }
]


let mymap
let cities = ''
let districts = ''
let camboriu

let store;
let myLayer;


axios.get('public/api/map/full')
    .then(function (response) {

        cities = response.data.cities;
        districts = response.data.districts
        camboriu = cities[0].city_coordinates.split(',')
        const { quantidade } = response.data.data

        mymap = L.map('mapid', {
            zoomControl: false,
        }).setView(camboriu, 13);

        L.control.zoom({
            position: 'bottomright'
        }).addTo(mymap);


        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZWRhbGljaW8iLCJhIjoiY2thZTVxb3hoMGdldTJybGR0bmRhMzgxeiJ9.2YVn5NR7K2g-mOF8yB4Y_Q', {
            attribution: ' &copy; <a href="http://www.camboriu.ifc.edu.br/">IFC - Campus Camboriú</a>',
            maxZoom: 17,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiZWRhbGljaW8iLCJhIjoiY2thZTVxb3hoMGdldTJybGR0bmRhMzgxeiJ9.2YVn5NR7K2g-mOF8yB4Y_Q'
        }).addTo(mymap);

        L.Control.Watermark = L.Control.extend({
            onAdd: function (mymap) {
                var img = L.DomUtil.create('img');
                img.src = 'public/img/logoIFC.png';
                img.style.width = '150px';
                return img;
            },
            onRemove: function (mymap) {
                // Nothing to do here
            }
        });

        L.control.watermark = function (opts) {
            return new L.Control.Watermark(opts);
        }

        L.control.watermark({ position: 'bottomleft' }).addTo(mymap);

        getCoordinates( cities[0].city_name ,  {
            "color": "#ff7800",
            "weight": 5,
            "opacity": 0.1
        } , cities[0] )

        store = [response.data.data.quantidade, cities[0].city_name]
        listInfo(response.data.data.quantidade, cities[0].city_name)
        map(response.data.data.locais);
        OptDistrict(districts)
        addhospital()


        divLoad.style.display = "none"



    })
    .catch(function (error) {
        // handle error
        console.log(error);
    })

const map = (position) => {
    position.map(e => {
        L.circle(e.position.split(','), {
            color: '#f00',
            fillOpacity: 0.5,
            radius: 200
        })
            .bindPopup(`<b>${e.name} : ${e.quantidade}</b>`)
            .addTo(mymap);
    })
}


document.getElementById('search-district').addEventListener('submit', (e) => {
    e.preventDefault()
    divLoad.style.display = "flex"

    const district_id = document.getElementById('select-search').value;

    axios.get(`public/api/map/${district_id}`)
        .then(function (response) {
            if (isEmpty(response.data.data.locais)) {
                console.log(response.data.data.locais);

                response.data.data.locais.map(e => {

                    mymap.flyTo(e.position.split(','), 15)
                });
                listInfo(response.data.data.quantidade, response.data.data.locais[0].name)
                divLoad.style.display = "none"

            } else {
                listInfo(store[0], store[1])
                divLoad.style.display = "none"
                mymap.flyTo(camboriu, 13)
            }
        })
})


function isEmpty(obj) {
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop))
            return true;
    }
    return false
}

document.getElementById('menu-info').addEventListener('click', e => {
    e.preventDefault();
    const infoBox = document.getElementById('info-box')
    if (infoBox.style.display === 'block') {
        infoBox.style.display = 'none';
    } else {
        infoBox.style.display = 'block';
    }
})


function addhospital() {
    dados['hospital'].map((e) => {
        console.log(e);
        L.marker(e.local.split(","),
            {
                icon: L.AwesomeMarkers.icon(
                    { icon: 'hospital-symbol', prefix: 'fa', markerColor: 'red' }
                )
            }
        )
            .bindPopup(`<b>${e.nome}.</b><br>Leitos: ${e.leitos} `)
            .addTo(mymap)
    });
}

function OptDistrict(districts) {
    let html = '<option selected disabled>Buscar por Bairro</option><option value="-0" >Ver Todos</option>'

    districts.map(e => {

        html += `<option value="${e.id}">${e.district_name}</option>`

    })
    document.getElementById('select-search').innerHTML = html
}

function listInfo(infos, name) {

    let html = ``

    infos.map(e => {
        const a = transformeIcon(e.tipo)
        console.log(a);


        html += `<li class="list-group-item d-flex justify-content-between align-items-center text-uppercase text-white"
        style="background: ${a.cor} ;">
                    ${a.html}
                    <span class="badge  badge-pill font-weight-bold"><h5>${e.quantidade}</h5></span>
                </li>`
    })
    document.getElementById('title-info').innerHTML = name

    document.getElementById('info-list').innerHTML = html
}

function transformeIcon(type) {
    console.log(type);
    let saida;
    STATUS.map(e => {
        if (e.name == type) {
            saida = {
                cor: e.color,
                html: `<h5 class="font-weight-bold"><i class="fas ${e.icon}  mr-2"></i>${type}</h5>`
            }
        }

    })

    return saida;
}




function getCoordinates(name , style = null , dados = null) {

  /*   axios.get(`https://nominatim.openstreetmap.org/reverse?format=geojson&polygon_geojson=1&limit=1&q=${name}`)
    .then(res => {
        let feature = res.data.features[0]
        feature.data = dados
        myLayer = L.geoJSON(feature, {
                style : style,
                onEachFeature: onEachFeature,
                pointToLayer: pointToLayer
        }
        ).addTo(mymap);

    }) */
}

function onEachFeature(feature, layer) {
    if(feature.data.name){
        layer.bindPopup(feature.data.name);
    } else {
        layer.bindPopup(feature.data.city_name)
    }

    layer.on({
        click: zoomToFeature
    });
}

function zoomToFeature(e) {
    mymap.fitBounds(e.target.getBounds());
}

function pointToLayer (feature, latlng) {
    console.log(feature);

    return L.circleMarker(feature.data, {
        radius: 8,
        fillColor: "#ff7800",
        color: "#000",
        weight: 1,
        opacity: 1,
        fillOpacity: 0.8
    });
}


