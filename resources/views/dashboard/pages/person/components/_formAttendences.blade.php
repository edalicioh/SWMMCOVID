<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Atendimento</h2>
        <div class="row">
            <div class="col-md-6">



                <div class="form-group">
                    <label for="annotations">Sintomas</label>
                    @foreach ($symptoms as $key => $symptom)
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" type="checkbox" id="symptom-{{ $symptom->id }}"
                                name="symptoms[]" value="{{ $symptom->id }}">
                            <label for="symptom-{{ $symptom->id }}"
                                class="custom-control-label text-uppercase">{{ $symptom->symptom_description }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-md-6">

                <div class="form-group">
                    <label for="disease">Condições de Risco</label>
                    @foreach ($diseases as $key => $disease)
                        <div class="custom-control custom-checkbox mb-3">
                            <input class="custom-control-input" type="checkbox" id="disease-{{ $disease->id }}"
                                name="diseases[]" value="{{ $disease->id }}">
                            <label for="disease-{{ $disease->id }}"
                                class="custom-control-label text-uppercase">{{ $disease->disease_description }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
