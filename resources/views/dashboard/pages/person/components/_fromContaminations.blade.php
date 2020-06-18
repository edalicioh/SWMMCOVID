<div class="card card-info card-outline">

    <div class="card-body">
      <h2 class="text-center">Local da Possível Contaminação</h2>

      <div class="form-group" >
        <label for="first_medical_care" class="required">Data dos primeiros sintomas</label>
        <input type="{{ isset($person->first_medical_care) ? 'date' : ' text' }}" class="form-control {{ isset($person->first_medical_care) ? '' : 'date-time ' }}  {{ $errors->has('first_medical_care') ? 'is-invalid' : '' }}" id="first_medical_care" name="first_medical_care" placeholder=""
        value="{{  old('first_medical_care') }}{{
          isset($person->first_medical_care)
            ? date( 'Y-m-d' , strtotime($person->first_medical_care)) : ''
          }}"
        {{ isset($person->first_medical_care) ? 'disabled'  : '' }}>
        @if ($errors->has('first_medical_care'))
        <div class="invalid-feedback">
            {{ $errors->first('first_medical_care') }}
        </div>
      @endif
    </div>

      <div class="form-group">
        <label for="possible_location" class="required">Local da Possível Contaminação</label>
        <select class="text-uppercase form-control {{ $errors->has('possible_location') ? 'is-invalid' : '' }}" id="possible_location" name="possible_location">
            <option  value="" disabled selected >Escolha</option>
                @foreach (Config::get( 'constants.POSSIBLE_LOCATION' ) as $key => $location )
                <option
                {{
                    ( old('possible_location') != null && old('possible_location') == $key )||
                    ( isset($person->possible_location) && $person->possible_location == $key) ? 'selected' : ''
                }}
                value="{{$key}}">{{$location}}</option>
                @endforeach
            </select>
            @if ($errors->has('possible_location'))
            <div class="invalid-feedback">
                {{ $errors->first('possible_location') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label class="required" for="contaminations_description">Descrição da Possível Contaminação</label>
            <textarea class="form-control {{ $errors->has('contaminations_description') ? 'is-invalid' : '' }}"
                id="contaminations_description" name="contaminations_description" rows="3">{{  old('contaminations_description') }}</textarea>
            @if ($errors->has('contaminations_description'))
            <div class="invalid-feedback">
                {{ $errors->first('contaminations_description') }}
            </div>
            @endif
        </div>
    </div>
</div>

