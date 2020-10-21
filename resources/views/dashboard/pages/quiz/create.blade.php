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
    <div class="row">
        @include('dashboard.pages.quiz.components._table')
    </div>

@stop


@section('js')
    <script>
        function editDisease(id) {
            const text = document.getElementById('disease-' + id).innerText;
            document.getElementById("disease_description").value = text
            document.getElementById("form-disease").action = 'disease/' + id
            document.getElementById('put-disease').innerHTML = '{{method_field('PUT')}}'
        }

        function editSymptom(id) {
            const text = document.getElementById('symptom-' + id).innerText;
            document.getElementById("symptom_description").value = text
            document.getElementById("form-symptom").action = 'symptom/' + id
            document.getElementById('put-symptom').innerHTML = '{{method_field('PUT')}}'
        }



    </script>
@stop
