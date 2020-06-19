@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Uploaded Arquivo </h1>
@stop

@section('content')
<form action="{{ route('csv.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card card-primary">

        <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv" >

          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-primary float-right">Salvar</button>
          </div>
      </div>
</form>
@stop

