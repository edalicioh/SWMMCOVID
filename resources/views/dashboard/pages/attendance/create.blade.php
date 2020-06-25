@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criar da Pessoa</h1>
@stop

@section('content')
<div class="card card-info card-outline">
    <div class="card-body">
        <div class="row">
            <div class="col">
                Nome: {{ $person->name }}<br>
                Telefone: {{ $person->phone }}
            </div>
            <div class="col"></div>
        </div>
    </div>
</div>


<form action="{{ route('attendance.store') }} " method="POST">
    @csrf
    <input type="hidden" name="person_id" value="{{ $person->id }}">

    <div class="row">
        <div class="col-md-12">
            @include('dashboard.pages.attendance.components._formAttendances')
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

$(function() {
    const locale = {
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "daysOfWeek": [
          "Dom",
          "Seg",
          "Ter",
          "Qua",
          "Qui",
          "Sex",
          "Sab"
        ],
        "monthNames": [
          "Janeiro",
          "Fevereiro",
          "Março",
          "Abril",
          "Maio",
          "Junho",
          "Julho",
          "Agosto",
          "Setembro",
          "Outubro",
          "Novembro",
          "Dezembro"
        ],
        "firstDay": 1
      }

    $('.date-time').daterangepicker({
      singleDatePicker: true,
      autoApply: true,

      maxDate : moment(),
      "locale": {
        "format": "DD/MM/YYYY",
        ...locale
      },
    })

    $('.date').daterangepicker({
      singleDatePicker: true,
      autoApply: true,

      "locale": {
        "format": "DD/MM/YYYY",
        ...locale
      },
    })

    $('.date-time-hour').daterangepicker({
      singleDatePicker: true,
      timePicker: true,
      timePicker24Hour: true,
      startDate: moment(),
      autoApply: true,
      maxDate : moment(),
      "locale": {
        "format": "DD/MM/YYYY H:mm",
        ...locale
      },
    })
    $('.date-up').daterangepicker({
      singleDatePicker: true,
      autoApply: true,
      drops: "up",
      "locale": {
        "format": "DD/MM/YYYY",
        ...locale
      },
    })



})

$(function() {
    $(".format-number").keypress(function(event) {
        if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
            $(".alert").html("Enter only digits!").show().fadeOut(2000);
            return false;
        }
    });
});
</script>
@stop
