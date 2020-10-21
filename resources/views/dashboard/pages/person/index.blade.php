@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Informações das Pessoas</h1>
@stop

@section('content')
<div class="row ">
    <div class="col">
        <div  class="mb-3">
            <a class="btn btn-secondary" id="download-xlsx" href="{{ route('downloadXlsx') }}">
                    <span>
                        <i class="fas fa-download"></i>
                        Baixar Excel
                    </span>
                </a>
        </div>
    </div>
</div>
<div class="pb-5">
    <table id="people-table" class="table table-striped table-bordered " ></table>
</div>
@stop

@section('js')
<script>





var table =  $('#people-table').DataTable({
    processing: true,
    serverSide: true,
    lengthMenu:[[10, 25, 50, -1], [10, 25, 50, "All"]],
    ajax: "{!! route('person.index') !!}",

    columns: [
        {data: 'person_name', name: 'person_name' , title: 'Nome'},
        {data: 'person_status', name: 'person_status', title: 'Status' },
        {
            data: 'discharge_date',
            name: 'discharge_date',
            title: 'Data da provavel alta',
            render: function( data, type, row, meta){
                console.log(data);
                        var ThisDate = data != null ?  moment(new Date(data)).format("DD/MM/YYYY") : "-";
                        return ThisDate
                    }
        },
        {data: 'district_name', name: 'district_name' , title: 'Bairro' },
        {data: 'phone', name: 'phone' , title: 'Telefone'},

        {
            "data": "action",
            "render": (data, type, row, meta) => {
                let edit = '{{ url("admin/person/id/edit") }}';
                let show = '{{ url("admin/historic/person") }}'
                let create = '{{ url("admin/attendance/person/create") }}'
                const deleted = "{{ url('admin/person/') }}" + '/'+row.person_id



                edit = edit.replace('/id/', '/'+row.person_id+'/');
                show = show.replace('person', row.person_id);
                create = create.replace('person', row.person_id);

                return `
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="${edit}" class="btn btn-xs btn-info "> <i class="fa fa-edit"></i></a>
                    <a href="${show}" class="btn btn-xs btn-primary ml-1"> <i class="fas fa-notes-medical"></i> </a>
                    <a href="${create}" class="btn btn-xs btn-secondary ml-1"> <i class="fas fa-plus"></i></a>
                    <a href="#" class="btn btn-xs btn-danger delete-person ml-1" data-id="${row.person_id}" data-token="{{ csrf_token() }}"> <i class="fas fa-trash"></i> </a>
                </div>
                ` ;
            }
        }
    ],
    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
    }
});


$('body').on('click','.delete-person', function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var token = $(this).data("token");
    $.ajax({
        type: "DELETE",
        url: 'person/'+id,
        data: {
                "id": id,
                "_method": 'DELETE',
                "_token": token,
            },
        success: function (response) {
            window.location = '{{ url("/admin/person") }}'
        }
    });
});



/*
new $.fn.dataTable.Buttons( table, {
    name: 'commands',

    buttons: [
        {
            extend: 'excelHtml5',
            autoFilter: true,
            text : '<i class="fas fa-download"></i> Baixar Excel',
            filename: 'lista_de_Contatos',
            exportOptions: {
                columns: [ 0, 1, 2, 3 ],
            },
        }
    ]
});

table.buttons( 0, null ).containers().appendTo( '#csv' ); */

const downloadXlsx = document.querySelector("#download-xlsx")

downloadXlsx.addEventListener('click',e => {
    downloadXlsx.innerHTML = `<i class="fas fa-spinner fa-spin  fa-fw" style=" font-size: 2rem; "></i>`;

    fetch("{{ route('downloadXlsx') }}")
        .then(function(response){
            downloadXlsx.innerHTML = `<span><i class="fas fa-download"></i> Baixar Excel </span>`;
        })
})


</script>
@stop
