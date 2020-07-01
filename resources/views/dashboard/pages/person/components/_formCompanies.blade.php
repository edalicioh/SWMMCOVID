<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Empresa</h2>

        <div class="form-group">
            <label for="company_name">Nome</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="">
          </div>

          <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj"  value="">
          </div>

          <div class="form-group">
          <label for="company_type" class="required">Tipo</label>
          <select class="text-uppercase  form-control" id="company_type" name="company_type">
              <option  value="" disabled selected >Escolha</option>
              @foreach (Config::get( 'constants.TYPE_COMPANY' ) as $key => $company )
                @if ($company !=  Config::get( 'constants.TYPE_COMPANY.ADMIN' ))
                    <option value="{{$company}}">{{ $key}}</option>
                @endif
              @endforeach
          </select>
      </div>
    </div>
</div>

