<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Adicionar Condição de Risco</h2>
        <form action="{{ route('disease.store') }} " method="POST">
            @csrf

            <div class="form-group">
                <label for="disease_description" class="required">Condição</label>
                <input type="text" class="form-control {{ $errors->has('disease_description') ? 'is-invalid' : '' }}"
                    id="disease_description" name="disease_description" placeholder=""
                    value="{{ old('disease_description')}}">
                    @if ($errors->has('disease_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disease_description') }}
                    </div>
                  @endif
              </div>


            <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
