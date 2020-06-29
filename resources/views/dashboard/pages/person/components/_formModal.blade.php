<form id="form-model-company" >
    @csrf
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.pages.person.components._formProfession')
        </div>
    </div>
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button  class="btn btn-primary " id="form-company">Salvar</button>
        </div>
    </div>
</form>
