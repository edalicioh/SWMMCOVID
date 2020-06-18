
<div class="col-md-4">
    <div class="card card-info card-outline">
        <div class="card-body">
            <h2 class="text-center">Tabela de endereços</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                      <th scope="col">Estado</th>
                      <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($states  as $item)
                    <tr>
                        <td>{{$item->state_name}}</td>
                        <td><button type="submit" data-id="{{ $item->id }}" class="btn btn-primary float-right estado">editar</button></td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-info card-outline">
        <div class="card-body">
            <h2 class="text-center">Tabela de endereços</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                      <th scope="col">cidade</th>
                      <th scope="col">estado</th>
                        <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $item)
                    <tr>
                        <td>{{$item->city_name}}</td>
                        <td>{{$item->uf}}</td>
                        <td><button type="submit" data-id="{{ $item->id }}" class="btn btn-primary float-right cidade">editar</button></td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-info card-outline">
        <div class="card-body">
            <h2 class="text-center">Tabela de endereços</h2>
            <table class="table table-striped">
                <thead>
                  <tr>
                      <th scope="col">Bairro</th>
                      <th scope="col">Cidade</th>
                      <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($district as $key => $item)
                    <tr>
                        <td>{{$item->district_name}}</td>
                        <td>{{ $item->city_name }}</td>
                        <td>
                            <button type="submit" data-id="{{ $key }}" class="btn btn-primary bairro">editar</button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



