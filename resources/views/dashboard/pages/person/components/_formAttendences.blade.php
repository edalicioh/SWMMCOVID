<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Atendimento</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="collection_id">Nome do local da coleta</label>
                    <select class="text-uppercase  form-control" id="collection_id" name="collection_id">
                        <option  value="" disabled selected >Escolha</option>
                        @foreach ($exams as $key => $exam )
                            <option value="{{$exam->id}}">{{$exam->name_location}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="collection_date">Data Coleta</label>
                    <input type="text"
                        class="form-control date-time-hour"
                        id="collection_date" name="collection_date" placeholder="">
                </div>

                <div class="form-group">
                    <label for="result_date">Data do Recebimento do Resultado</label>
                    <input type="text" class="form-control date" id="result_date" name="result_date" placeholder="">
                </div>

                <div class="form-group">
                    <label for="exam_result">Resultado do exame</label>
                    <select class=" text-uppercase form-control" id="exam_result" name="exam_result">
                        <option value="" disabled selected >Escolha</option>
                        @foreach (Config::get( 'constants.ATTENDANCES' ) as $key => $exam )
                            <option value="{{$key}}">{{$exam}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="date">Data do atendimento</label>
                    <input type="text" class="form-control date-time-hour" id="date" name="date" placeholder="">
                </div>
                <div class="form-group">
                    <label for="annotations">Anotações</label>
                    <textarea class="form-control" id="annotations" name="annotations" rows="3"></textarea>
                </div>



                <input type="hidden" name="patient" id="patient">

                <div class="form-group">
                    <label for="person_status" class="required">Estado da pessoa</label>
                    <select class="text-uppercase  form-control {{ $errors->has('person_status') ? 'is-invalid' : '' }}"
                         id="person_status" name="person_status">
                        <option  value="" disabled selected >Escolha</option>
                        @foreach (Config::get( 'constants.STATUS' ) as $key => $status )
                        @if ($key != 1)
                        <option
                            {{
                            (old('person_status') != null && old('person_status') == $key ) ||
                            ( isset($person->person_status) && $person->person_status == $key ) ? 'selected' : ''
                            }}
                            value="{{$key}}">{{$status}}</option>
                        @endif
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                </div>

                <div class="form-group" id="from-hospital">
                    <label for="hospital" class="required">Local de Acompanhamento</label>
                    <select class="form-control" id="hospital" name="hospital_id">
                        <option value="" disabled selected >Escolha o estado</option>
                        @foreach ($hospitais as $hospital)
                            <option value="{{$hospital->id}}">{{$hospital->hospital_name}}</option>
                        @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="discharge_date">Data da provável alta</label>
                    <input type="text" class="form-control date-up" id="discharge_date" name="discharge_date" placeholder="">
                </div>


            </div>
            <div class="col-md-6">


                <div class="form-group">
                    <label for="annotations">Sintomas</label>
                    @foreach ($symptoms  as $key => $symptom)
                    <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="symptom-{{$symptom->id}}" name="symptoms[]" value="{{$symptom->id}}">
                    <label for="symptom-{{$symptom->id}}" class="custom-control-label text-uppercase">{{$symptom->symptom_description}}</label>
                    </div>
                    @endforeach
                </div>

                <div class="form-group">
                    <label for="disease">Condições de Risco</label>
                    @foreach ($diseases as $key => $disease)
                    <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" type="checkbox" id="disease-{{$disease->id}}" name="diseases[]" value="{{$disease->id}}">
                    <label for="disease-{{$disease->id}}" class="custom-control-label text-uppercase">{{$disease->disease_description}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>


