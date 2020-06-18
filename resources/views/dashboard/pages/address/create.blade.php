@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criação novo Local</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('dashboard.pages.address.components._formState')
    </div>
    <div class="col-md-4">
        @include('dashboard.pages.address.components._fromCity')
    </div>
    <div class="col-md-4">
        @include('dashboard.pages.address.components._fromDistrict')
    </div>
</div>
<div class="row">
    @include('dashboard.pages.address.components._table')
</div>
@stop


@section('js')
<script>

    document.getElementById('search-state').addEventListener('click', e => {
        e.preventDefault()
        const state = document.getElementById('state_name').value

        if (state) {
            axios.get(`https://nominatim.openstreetmap.org/search?format=json&limit=1&namedetails=1&state=${state}`)
                .then(res => {
                    if (res.data.length){
                        const conf = confirm("Confirmação do nome: " + res.data[0].display_name );

                        if (conf) {
                            document.getElementById('state_name').value =res.data[0].namedetails.name
                            document.getElementById('uf').value = res.data[0].namedetails.short_name
                            document.getElementById('state_coordinates').value = res.data[0].lat+','+res.data[0].lon
                        }
                    } else {
                        alert('Dados errados')
                    }
            })
        } else {
            alert('Para a busca o campo nome deve ser preenchido')
        }
    })

    document.getElementById('search-city').addEventListener('click', e => {
        e.preventDefault()
        const city = document.getElementById('city_name').value
        const state = document.getElementById('state').options[document.getElementById('state').selectedIndex].innerText


        if (city) {
            axios.get(`https://nominatim.openstreetmap.org/search?format=json&limit=1&namedetails=1&state=${state}&city=${city}`)
                .then(res => {

                    if (res.data.length){
                        const conf = confirm("Confirmação do nome: " + res.data[0].display_name );

                        if (conf) {
                            document.getElementById('city_name').value =res.data[0].namedetails.name
                            document.getElementById('city_coordinates').value = res.data[0].lat+','+res.data[0].lon
                        }
                    } else {
                        alert('Dados errados')
                    }
            })
        } else {
            alert('Para a busca o campo nome deve ser preenchido')
        }
    })

    document.getElementById('search-district').addEventListener('click', e => {
        e.preventDefault()

        const district  = document.getElementById('district_name').value
        const city = document.getElementById('city').options[document.getElementById('city').selectedIndex].innerText

        if (district) {
            axios.get(`https://nominatim.openstreetmap.org/search?format=json&namedetails=1&q=${district}+${city}`)
                .then(res => {
                    if (res.data.length){
                        const conf = confirm("Confirmação do nome: " + res.data[0].display_name );

                        if (conf) {
                            document.getElementById('district_name').value =res.data[0].namedetails.name
                            document.getElementById('district_coordinates').value = res.data[0].lat+','+res.data[0].lon
                        }
                    } else {
                        alert('Dados errados')
                    }

            })
        } else {
            alert('Para a busca o campo nome deve ser preenchido')
        }
    })

    $('.bairro').click(function (e) {
        e.preventDefault();
        console.log(e.target.dataset.id);

    });


</script>
@stop
