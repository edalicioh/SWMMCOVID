<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center"> Adicionar Sintoma</h2>
        <form action="{{ route('symptom.store') }} " method="POST">
            @csrf

            <div class="form-group">
                <label for="symptom_description" class="required">Sintoma</label>
                <input type="text" class="form-control {{ $errors->has('symptom_description') ? 'is-invalid' : '' }}"
                    id="symptom_description" name="symptom_description" placeholder=""
                    value="{{ old('symptom_description')}}">
                    @if ($errors->has('symptom_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('symptom_description') }}
                    </div>
                  @endif
              </div>


            <button type="submit" class="btn btn-primary float-right">Salvar</button>
        </form>
    </div>
</div>
