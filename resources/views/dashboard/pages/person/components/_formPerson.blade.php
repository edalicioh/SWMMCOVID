
<div class="card card-info card-outline">

      <div class="card-body">
        <h2 class="text-center">Dados Pessoais</h2>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="person_name" class="required">Nome</label>
                  <input type="text"
                  class="form-control {{ $errors->has('person_name') ? 'is-invalid' : '' }}"
                  id="person_name" name="person_name" placeholder=""
                    value="{{  old('person_name') }}{{ isset($person->person_name) ? $person->person_name : '' }}"
                    {{ isset($person->person_name) ? 'disabled    '  : '' }}>
                    @if ($errors->has('person_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('person_name') }}
                    </div>
                  @endif
                  </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="gender" class="required">Genero</label>
                    <select class="text-uppercase form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" id="gender" name="gender">
                        <option value="" disabled selected >Escolha</option>
                        @foreach (['M' => 'Masculino' , 'F' => 'Feminino' , 'O' => 'Outros' ]   as $key  =>  $item)
                          <option
                          {{
                            ( old('gender') == $key ) ||
                            ( isset($person->gender) && $person->gender == $key) ? 'selected' : ''
                          }}
                            value="{{ $key }}">{{  $item }}</option>
                        @endforeach

                    </select>
                    @if ($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                  @endif
                  </div>
            </div>
          </div>


        <div class="form-group">
            <label for="cpf" class="required">CPF</label>
          <input type="text" class="form-control {{ $errors->has('cpf') ? 'is-invalid' : '' }}" id="cpf" data-mask="000.000.000-00" name="cpf" placeholder=""
            value="{{  old('cpf') }}{{ isset($person->cpf) ? $person->cpf : '' }}" {{ isset($person->cpf) ? 'disabled    '  : '' }}>
            @if ($errors->has('cpf'))
            <div class="invalid-feedback">
                {{ $errors->first('cpf') }}
            </div>
          @endif
        </div>
        <div class="form-group">
            <label for="sus_id">Numero do sus</label>
          <input
            type="text" class="form-control" id="sus_id" name="sus_id" placeholder=""
            value="{{  old('sus_id') }}{{ isset($person->sus_id) ? $person->sus_id : '' }}"
            {{ isset($person->sus_id) ? 'disabled'  : '' }} data-mask="000 0000 0000 0000">
        </div>
        <div class="form-group">
            <label for="phone" class="required">Telefone</label>
          <input type="tel" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
          id="phone" name="phone" placeholder="" data-mask="(00) 0 0000-0000"
           value="{{  old('phone') }}{{ isset($person->phone) ? $person->phone : '' }}">
           @if ($errors->has('phone'))
           <div class="invalid-feedback">
               {{ $errors->first('phone') }}
           </div>
         @endif
        </div>
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    <label for="birth_date">Data de nascimento</label>
                    <input type="{{ isset($person->first_medical_care) ? 'date' : ' text' }}" class="form-control {{ isset($person->first_medical_care) ? '' : 'date-time ' }} id="birth_date" name="birth_date" laceholder=""
                    value="{{  old('birth_date') }}{{ isset($person->birth_date) ? $person->birth_date : '' }}" {{ isset($person->birth_date) ? 'disabled    '  : '' }}>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group" >
                    <label for="age" class="required">Idade</label>
                    <input type="number"  class="form-control  format-number  {{ $errors->has('age') ? 'is-invalid' : '' }}" id="age" name="age" placeholder=""
                    value="{{  old('age') }}{{ isset($person->age) ? $person->age : '' }}">
                    @if ($errors->has('age'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </div>
                  @endif
                </div>
            </div>
        </div>



      </div>
</div>


