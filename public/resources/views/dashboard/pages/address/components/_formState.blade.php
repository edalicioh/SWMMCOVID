<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Adicionar Estado</h2>
        <form action="{{ route('state.store') }} " method="POST">
            @csrf
            <div class="form-group">
                <label for="state_name" class="required">Nome do Estado</label>
                <input type="text" class="form-control {{ $errors->has('state_name') ? 'is-invalid' : '' }}"
                    id="state_name" name="state_name" placeholder=""
                    value="{{ old('state_name')}}">
                    @if ($errors->has('state_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state_name') }}
                    </div>
                  @endif
              </div>

              <div class="form-group">
                <label for="uf" class="required">UF</label>
                <input type="text" class="form-control {{ $errors->has('uf') ? 'is-invalid' : '' }}"
                    id="uf" name="uf" placeholder=""
                    value="{{ old('uf')}}">
                    @if ($errors->has('uf'))
                    <div class="invalid-feedback">
                        {{ $errors->first('uf') }}
                    </div>
                  @endif
              </div>

              <div class="form-group">
                <label for="state_coordinates" class="required">Posição central do Estado</label>
                <input type="text" class="form-control {{ $errors->has('state_coordinates') ? 'is-invalid' : '' }}"
                    id="state_coordinates" name="state_coordinates" placeholder=""
                    value="{{ old('state_coordinates')}}">
                    @if ($errors->has('state_coordinates'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state_coordinates') }}
                    </div>
                  @endif
              </div>
                <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
