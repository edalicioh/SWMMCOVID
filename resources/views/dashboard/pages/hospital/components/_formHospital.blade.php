<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Dados do Hospital</h2>

        <div class="form-group">
            <label for="hospital_name" class="required">Nome</label>
            <input type="text" class="form-control {{ $errors->has('hospital_name') ? 'is-invalid' : '' }}"
                id="hospital_name" name="hospital_name" placeholder=""
                value="{{ old('hospital_name')}}{{ isset($hospital->hospital_name) ? $hospital->hospital_name : '' }}">

                @if ($errors->has('hospital_name'))
                <div class="invalid-feedback">
                  {{ $errors->first('hospital_name') }}
                </div>
              @endif
        </div>

        <div class="form-group">
            <label for="icu_beds" class="required">Numero de Leitos de UTI</label>
            <input type="text" class="form-control {{ $errors->has('icu_beds') ? 'is-invalid' : '' }}"
                id="icu_beds" name="icu_beds" placeholder=""
                value="{{ old('icu_beds')}}{{ isset($hospital->icu_beds) ? $hospital->icu_beds : '' }}">

                @if ($errors->has('icu_beds'))
                <div class="invalid-feedback">
                  {{ $errors->first('icu_beds') }}
                </div>
              @endif
        </div>

        <div class="form-group">
            <label for="infirmary_beds" class="required">Numero de Leitos de Enfermaria</label>
            <input type="text" class="form-control {{ $errors->has('infirmary_beds') ? 'is-invalid' : '' }}"
                id="infirmary_beds" name="infirmary_beds" placeholder=""
                value="{{ old('infirmary_beds')}}{{ isset($hospital->infirmary_beds) ? $hospital->infirmary_beds : '' }}">

                @if ($errors->has('infirmary_beds'))
                <div class="invalid-feedback">
                  {{ $errors->first('infirmary_beds') }}
                </div>
              @endif
        </div>
        <div class="form-group">
            <label for="hospital_location" class="required">Latitude e Longitude</label>
            <input type="text" class="form-control {{ $errors->has('hospital_location') ? 'is-invalid' : '' }}"
                id="hospital_location" name="hospital_location" placeholder=""
                value="{{ old('hospital_location')}}{{ isset($hospital->hospital_location) ? $hospital->hospital_location : '' }}">

                @if ($errors->has('hospital_location'))
                <div class="invalid-feedback">
                  {{ $errors->first('hospital_location') }}
                </div>
              @endif
        </div>
    </div>
</div>
