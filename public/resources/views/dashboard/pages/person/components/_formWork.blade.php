<div class="card card-info card-outline">

    <div class="card-body">
      <h2 class="text-center">Local de Trabalho</h2>
      <div class="form-group">

        <label for="work_status" class="required">Setor de trabalho</label>
        <select class="text-uppercase form-control {{ $errors->has('work_status') ? 'is-invalid' : '' }}" id="work_status" name="work_status">
            <option  value="" disabled selected >Escolha</option>
            @foreach (Config::get( 'constants.WORK_STATUS' ) as $key => $work )
            <option
            {{
              ( old('work_status') != null && old('work_status') == $key )||
              ( isset($person->work_status) && $person->work_status == $key) ? 'selected' : ''
            }}
            value="{{$key}}">{{$work}}</option>
            @endforeach
          </select>
        @if ($errors->has('work_status'))
        <div class="invalid-feedback">
            {{ $errors->first('work_status') }}
        </div>
      @endif
      </div>
      <div class="form-group" >
        <label for="companies" class="required">Empresa Nome / CNPJ</label>
        <select class="form-control" id="companies" name="company_id">
            <option value="" disabled selected >Escolha</option>
            @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}} / {{$company->cnpj}}</option>
            @endforeach
        </select>
      </div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
       Nova empresa
    </button>
    </div>
</div>


