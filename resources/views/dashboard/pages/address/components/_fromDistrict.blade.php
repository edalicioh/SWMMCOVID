<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Adicionar Bairro</h2>
        <form id="from-district" action="{{ route('district.store') }} " method="POST">
            @csrf
            <div id="put-district"></div>
            <div class="form-group">
            <label for="city" class="required">Cidade</label>
            <select class="form-control {{ $errors->has('city_id') ? 'is-invalid' : '' }}" id="city" name="city_id">
                <option value="" disabled selected>Escolha a cidade</option>
                @foreach ($cities as $city)
                    <option
                    id="city-{{ $city->cities_id }}"
                    {{ old('city_id') == $city->cities_id ? 'selected' : ''  }}
                    value="{{$city->cities_id}}">{{$city->city_name}}</option>
                @endforeach
            </select>
            @if ($errors->has('city_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city_id') }}
                    </div>
                  @endif
          </div>

              <div class="form-group">
                <label for="district_name"  class="required">Nome do Bairro</label>
                <input type="text" class="form-control {{ $errors->has('district_name') ? 'is-invalid' : '' }}"
                    id="district_name" name="district_name" placeholder=""
                    value="{{ old('district_name')}}">
                    @if ($errors->has('district_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district_name') }}
                    </div>
                  @endif
              </div>

              <div class="form-group">
                <label for="district_coordinates"  class="required">Posição central do Bairro</label>
                <input type="text" class="form-control {{ $errors->has('district_coordinates') ? 'is-invalid' : '' }}"
                    id="district_coordinates" name="district_coordinates" placeholder=""
                    value="{{ old('district_coordinates')}}">
                    @if ($errors->has('district_coordinates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('district_coordinates') }}
                    </div>
                  @endif
              </div>

              <button type="submit" class="btn btn-primary float-left" id="search-district">Buscar</button>
            <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
