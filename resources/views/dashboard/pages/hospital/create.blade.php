@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Cadastrar Hospital</h1>
@stop

@section('content')
<form action="{{ isset( $hospital ) ?  route('hospital.update' ,  $hospital->id) : route('hospital.store') }} " method="POST">
    @isset($hospital)
      @method('PUT')
    @endisset
    @csrf
    @if ($errors->any() )
        <div class="alert alert-danger" role="alert">
            <b>ERRO:</b> Todo os campos com asterisco ( * ) devem ser preenchidos
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            @include('dashboard.pages.hospital.components._formHospital')
        </div>
        <div class="col-md-6">
            @include('dashboard.pages.hospital.components._formAddress')
        </div>
    </div>
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary ">Salvar</button>
        </div>
    </div>
</form>
@stop


@section('js')
<script>
//-----------
// pega cidade por ID do estado
//-----------
document.getElementById('state').addEventListener('change' ,(e) => {
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
        document.getElementById('city').innerHTML = html
    })

})
//-----------
// pega bairro por ID do cidade
//-----------
document.getElementById('city').addEventListener('change' ,(e) => {
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
        document.getElementById('district').innerHTML = html
    })

})
</script>
@stop

