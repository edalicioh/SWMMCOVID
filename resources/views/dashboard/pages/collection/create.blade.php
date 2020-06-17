@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criação um novo local de coleta</h1>
@stop

@section('content')

<form  action="{{ route('collection.store') }} " method="POST" >
    @csrf
    <div class="row">
        <div class="col-md-6">

            @include('dashboard.pages.person.components._formExam')
        </div>
        <div class="col-md-6">
            @include('dashboard.pages.person.components._formAddress')
        </div>
    </div>
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button  type="submit" class="btn btn-primary ">Salvar</button>
        </div>
    </div>
</form>


@stop


@section('js')
<script>
    //-----------
// pega cidade por ID do estado
//-----------

$('.state').change( (e) => {
    axios.get('../../api/state/'+ e.target.value)
    .then(function (response) {
        let html = '<option value="" disabled selected >Escolha o cidade</option>';
        response.data.map(element => {
           html += `
            <option
                    value="${element.id}">${element.city_name}
            </option>
            `
            console.log(element);
        })
        $('.city').html(html)
    })

})
//-----------
// pega bairro por ID do cidade
//-----------
$('.city').change( (e) => {
    axios.get('../../api/city/'+ e.target.value)
    .then(function (response) {
        let html = '<option value="" disabled selected >Escolha o bairro</option>';
        response.data.map(element => {
           html += `
            <option
                    value="${element.id}">${element.district_name}
            </option>
            `
            console.log(element);
        })
        $('.district').html(html)
    })

})
</script>
@stop
