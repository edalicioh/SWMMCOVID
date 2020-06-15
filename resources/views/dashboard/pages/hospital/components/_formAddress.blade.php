<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Endereço</h2>
        <div class="row">
            <div class="col-9">
                <div class="form-group">
                  <label for="street" class="required">Rua</label>
                  <input type="text" class="form-control {{ $errors->has('street') ? 'is-invalid' : '' }}" id="street"
                      name="street" placeholder=""
                      value="{{  old('street') }}{{ isset($address->street) ? $address->street : '' }}" >
                  @if ($errors->has('street'))
                    <div class="invalid-feedback">
                        {{ $errors->first('street') }}
                    </div>
                  @endif
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="number" class="required">Numero</label>
                    <input type="number"
                    class="form-control format-number {{ $errors->has('number') ? 'is-invalid' : '' }}"
                    id="number" name="number" placeholder="" value="{{  old('number') }}{{ isset($address->number) ? $address->number : '' }}">
                    @if ($errors->has('number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number') }}
                    </div>
                  @endif
                  </div>
            </div>
          </div>

          <div class="form-group">
            <label for="state" class="required">Estado</label>
            <select class="form-control  {{ $errors->has('state_id') ? 'is-invalid' : '' }}" id="state" name="state_id">
                <option value="" disabled selected >Escolha o estado</option>

                @foreach ($states as $state)
                    <option
                    {{ old('state_id') == $state->id ? 'selected' : ''  }}
                    {{  isset($address->state_id) && $address->state_id == $state->id ? 'selected' : '' }}
                    value="{{$state->id}}">{{$state->state_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('state_id'))
            <div class="invalid-feedback">
                {{ $errors->first('state_id') }}
            </div>
          @endif
          </div>

          <div class="form-group">
            <label for="city" class="required">Cidade</label>
            <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" id="city" name="city_id">
                <option value="" disabled selected>Escolha a cidade</option>
                @if ($errors->has('city_id') || isset($address->city_id) || old('city_id') )
                    @foreach ($cities as $city)
                        <option
                        {{ old('city_id') == $city->id ? 'selected' : ''  }}
                        {{  isset($address->city_id) && $address->city_id == $city->id ? 'selected' : '' }}
                        value="{{$city->id}}">{{$city->city_name}}</option>
                    @endforeach
                @endif
            </select>
            @if ($errors->has('city_id'))
                <div class="invalid-feedback">
                    {{ $errors->first('city_id') }}
                </div>
            @endif
          </div>


          <div class="form-group">
            <label for="district" class="required">Bairro</label>
            <select class="form-control {{ $errors->has('district_id') ? 'is-invalid' : '' }}" id="district" name="district_id">
                <option value="" disabled selected >Escolha o bairro</option>
                @if ($errors->has('district_id') || isset($address->district_id) || old('city_id'))
                    @foreach ($districts as $district)
                        <option
                        {{ old('district_id') == $district->id ? 'selected' : ''  }}
                        {{ isset($address->district_id) && $address->district_id == $district->id ? 'selected' : '' }}
                        value="{{$district->id}}">{{$district->district_name}}</option>
                    @endforeach
                @endif
            </select>
              @if ($errors->has('district_id'))
              <div class="invalid-feedback">
                {{ $errors->first('district_id') }}
              </div>
            @endif
          </div>
          <div class="form-group">
            <label for="observation">Observação</label>
            <input type="text" class="form-control" id="observation" name="observation" placeholder="" value="{{ old('observation')}}{{ isset($address->observation) ? $address->observation : '' }}">
          </div>

      </div>
</div>
