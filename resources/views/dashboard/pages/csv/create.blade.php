@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Uploaded Arquivo </h1>
@stop

@section('content')
<form action="{{ route('csv.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">

        <input type="file" class="form-control-file" id="csv_file" name="csv_file"  >

          </div>
          <div class="card-footer">
            <button type="submit" id="save-sheet" class="btn btn-primary float-right">Salvar</button>
          </div>
      </div>
</form>
@stop

@section('js')
<script>  
  document.querySelector("#save-sheet").addEventListener('click',e => {
    document.querySelector("#save-sheet").innerHTML = `<i class="fas fa-spinner fa-spin  fa-fw" style=" font-size: 2rem; "></i>`;
  })
</script>
@stop

