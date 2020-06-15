@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criação novo Local</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        @include('dashboard.pages.address.components._formState')
    </div>
    <div class="col-md-4">
        @include('dashboard.pages.address.components._fromCity')
    </div>
    <div class="col-md-4">
        @include('dashboard.pages.address.components._fromDistrict')
    </div>
</div>
@stop


@section('js')
<script></script>
@stop
