@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Informações dos Hospitais</h1>
@stop

@section('content')
<div class="pb-5">
    <table id="people-table" class="table table-striped table-bordered "></table>
</div>
@stop

@section('js')
<script>




$('#people-table').DataTable({
    processing: true,
    serverSide: true,

    ajax: "{!! route('hospital.index') !!}",

    columns: [
        {data: 'hospital_name', name: 'hospital_name' , title: 'Nome'},
        {data: 'icu_beds', name: 'icu_beds' , title: 'Leitos de UTI'},
        {data: 'infirmary_beds', name: 'infirmary_beds' , title: 'Leitos de Enfermaria'},

        {
            "data": "action",
            "render": (data, type, row, meta) => {
                let edit = '{{ url("admin/hospital/id/edit") }}';

                edit = edit.replace('id', row.id);

                return `
                    <a href="${edit}" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> Editar</a>
                ` ;
            }
        }

    ],

    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
    }
});

</script>
@stop
