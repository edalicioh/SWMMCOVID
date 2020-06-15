@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<div class="d-flex justify-content-between">
    <h1>Histórico de Atendimento</h1>
    <a href="{{ url()->previous() }}" class="btn btn-info"><i class="fas fa-arrow-left mr-2"></i>Voltar</a>
</div>
@stop

@section('content')
<div class="card card-info card-outline">
    <div class="card-body">
        <div class="row">
            <div class="col">
                Nome: {{ $person->person_name }}<br>
                Telefone: {{ $person->phone }}
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>
    @include('dashboard.pages.attendance.components._table')
@stop

