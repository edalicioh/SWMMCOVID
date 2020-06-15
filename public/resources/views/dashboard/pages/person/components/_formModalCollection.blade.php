<form id="form-model-exam" >
    @csrf
    <div class="row">
        <div class="col-md-12">

            @include('dashboard.pages.person.components._formExam')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('dashboard.pages.person.components._formAddress')
        </div>
    </div>
    <div class="row  pb-3 text-right">
        <div class="col-md-12">
            <button  type="submit" class="btn btn-primary ">Salvar</button>
        </div>
    </div>
</form>
