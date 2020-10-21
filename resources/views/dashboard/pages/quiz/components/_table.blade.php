<div class="col-md-6">
    <div class="card card-info card-outline">
        <div class="card-body">
            <h2 class="text-center">Tabela de Sintoma</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Sintoma</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($symptom as $item)
                    <tr>
                        <td id="symptom-{{ $item->id }}">{{ $item->symptom_description }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button onclick="editSymptom({{ $item->id }})" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card card-info card-outline">
        <div class="card-body">
            <h2 class="text-center">Tabela de Condições</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Condição de Risco</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disease as $item)
                        <tr>
                            <td id="disease-{{ $item->id }}">{{ $item->disease_description }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button onclick="editDisease({{ $item->id }})" class="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
