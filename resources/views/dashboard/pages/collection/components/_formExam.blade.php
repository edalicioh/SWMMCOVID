<div class="card card-info card-outline">
    <div class="card-body">
        <h2 class="text-center">Dados do local de coleta</h2>
        <div class="form-group">
            <label for="name_location">Nome do local da coleta</label>
            <input type="text" class="form-control " id="name_location" name="name_location" placeholder="">
        </div>
        <div class="form-group">
            <label for="type_location" class="required">Tipo de Local</label>
            <select class="text-uppercase  form-control" id="type_location" name="type_location">
                <option  value="" disabled selected >Escolha</option>
                @foreach (Config::get( 'constants.EXAM_STATUS' ) as $key => $status )
                    <option value="{{$key}}">{{$status}}</option>
                @endforeach
            </select>

        </div>
    </div>
</div>
