<form id="form-model-company" >
    @csrf
    <div class="row">
        <div class="col-md-6">
            @include('dashboard.pages.person.components._formCompanies')
        </div>
        <div class="col-md-6">
            @include('dashboard.pages.person.components._formAddress')
        </div>
    </div>
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button  type="submit" class="btn btn-primary ">Salvar</button>
        </div>
    </div>
</form>
