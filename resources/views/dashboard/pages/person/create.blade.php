@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Criação de uma nova Pessoa</h1>
@stop

@section('content')


<form action="{{ isset( $person ) ?  route('person.update' ,  $person->id) : route('person.store') }} " method="POST">
    @isset($person )
      @method('PUT')
    @endisset
    @csrf
    @if ($errors->any() )
    <div class="alert alert-danger" role="alert">
     <b>ERRO:</b> Todo os campos com asterisco ( * ) devem ser preenchidos
    </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            @include('dashboard.pages.person.components._formPerson')
            @if(!isset($person) )
                @include('dashboard.pages.person.components._formWork')

            @endif
        </div>
        <div class="col-md-6">
            @include('dashboard.pages.person.components._formAddress')
            @if(!isset($person) )
                @include('dashboard.pages.person.components._fromContaminations')
            @endif
        </div>
    </div>
    @if(!isset($person) )
        <div class="row">
            <div class="col-md-12">
                @include('dashboard.pages.person.components._formAttendences')
            </div>
        </div>
    @endif
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary ">Salvar</button>
        </div>
    </div>
</form>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Novo Local</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('dashboard.pages.person.components._formModal')
        </div>
      </div>
    </div>
  </div>




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


document.getElementById('patient').value = false

const form = document.getElementById('form-model-company')

form.addEventListener('submit', e => {
    e.preventDefault()
    const data = {

       'professions_description' : form.elements.professions_description.value,

    }

    axios.post('{{ route('profession.store') }}' , data)
    .then(response => {
        console.log(response);

        if ( response.data ) {
            let html = '<option value="" disabled selected >Escolha</option>'

            response.data.map(elem => {
                html += `<option value="${elem.id}">${elem.professions_description}</option>`
            })
            html += '<option value="não informado" >não informado</option>'
            document.getElementById('professions_description').innerHTML = html
            $('#exampleModal').modal('hide')
        }
    })
})

//-----------
// pega cidade por ID do estado
//-----------

$('.state').change( (e) => {
    axios.get('../../api/state/'+ e.target.value)
    .then(function (response) {
        let html = '<option value="" disabled selected >Escolha o cidade</option>';
        response.data.map(element => {
           html += `
            <option
                    value="${element.id}">${element.city_name}
            </option>
            `
            console.log(element);
        })
        $('.city').html(html)
    })

})
//-----------
// pega bairro por ID do cidade
//-----------
$('.city').change( (e) => {
    axios.get('../../api/city/'+ e.target.value)
    .then(function (response) {
        let html = '<option value="" disabled selected >Escolha o bairro</option>';
        response.data.map(element => {
           html += `
            <option
                    value="${element.id}">${element.district_name}
            </option>
            `
            console.log(element);
        })
        $('.district').html(html)
    })

})



</script>
@stop
