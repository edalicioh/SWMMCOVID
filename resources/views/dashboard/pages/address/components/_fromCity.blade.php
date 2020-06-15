<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Adicionar Cidade</h2>
        <form action="{{ route('city.store') }} " method="POST">
            @csrf
            <div class="form-group">
                <label for="state" class="required">Estado</label>
                <select class="form-control  {{ $errors->has('state_id') ? 'is-invalid' : '' }}" id="state" name="state_id">
                    <option value="" disabled selected >Escolha o estado</option>
                    @foreach ($states as $state)
                        <option
                        {{ old('state_id') == $state->id ? 'selected' : ''  }}
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
                <label for="city_name" class="required">Nome da Cidade</label>
                <input type="text" class="form-control  {{ $errors->has('city_name') ? 'is-invalid' : '' }}"
                    id="city_name" name="city_name" placeholder=""
                    value="{{ old('city_name')}}">
                    @if ($errors->has('city_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city_name') }}
                    </div>
                  @endif
              </div>

              <div class="form-group">
                <label for="city_coordinates" class="required">Posição central da Cidade</label>
                <input type="text" class="form-control  {{ $errors->has('city_coordinates') ? 'is-invalid' : '' }}"
                    id="city_coordinates" name="city_coordinates" placeholder=""
                    value="{{ old('city_coordinates')}}">
                    @if ($errors->has('city_coordinates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city_coordinates') }}
                    </div>
                  @endif
              </div>
                <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
