@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Informações das Pessoas</h1>
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

    ajax: "{!! route('person.index') !!}",

    columns: [
        {data: 'person_name', name: 'person_name' , title: 'Nome'},
        {data: 'person_status', name: 'person_status', title: 'Status' },
        {data: 'district_name', name: 'district_name' , title: 'Bairro' },
        {data: 'phone', name: 'phone' , title: 'Telefone'},

        {
            "data": "action",
            "render": (data, type, row, meta) => {
                let edit = '{{ url("admin/person/id/edit") }}';
                let show = '{{ url("admin/historic/person") }}'
                let create = '{{ url("admin/attendance/person/create") }}'

                edit = edit.replace('/id/', '/'+row.person_id+'/');
                show = show.replace('person', row.person_id);
                create = create.replace('person', row.person_id);

                return `
                    <a href="${edit}" class="btn btn-xs btn-info"> <i class="fa fa-edit"></i> Editar</a>
                    <a href="${show}" class="btn btn-xs btn-primary"> <i class="fas fa-notes-medical"></i> Historico</a>
                    <a href="${create}" class="btn btn-xs btn-secondary"> <i class="fas fa-plus"></i> Atendimento</a>
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
