@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criação nova Peguntas</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        @include('dashboard.pages.quiz.components._fromSymptom')
    </div>
    <div class="col-md-6">
        @include('dashboard.pages.quiz.components._fromDiseases')
    </div>
</div>
@stop


@section('js')
<script></script>
@stop
