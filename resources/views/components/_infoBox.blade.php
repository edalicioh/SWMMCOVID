<div id="info-box" class="shadow-lg">
    <div class="card">
        <div class="card-body" style="background: #74759e2e">
            <h2 class="card-title text-center " id="" >Boletim Covid-19</h2>
            <h2 class="card-title text-center " id="title-info" >Camboriu</h2>
            {{--
                <h6 class="card-title text-center " id="" >Dados atualizados 11/11/1111</h6>
            --}}
                <div class="row my-1">
                    <div class="col-10 border-right rounded font-weight-bolder text-white info-label"  style="background: #E21E26;">
                        <i class="fas fa-check mr-2"></i> Positivos
                    </div>
                    <div class="col-2 text-center border-left rounded font-weight-bolder text-white info-count" id="positivo" style="background: #E21E26 ;  ">
                         0
                    </div>
                </div>
                <div class="row my-1">
                    <div class="col-10 border-right rounded font-weight-bolder text-white info-label"  style="background: #008F5A ;  ">
                        <i class="fas fa-smile mr-2"></i> Recuperados
                    </div>
                    <div class="col-2 text-center border-left rounded font-weight-bolder text-white info-count"  id="recuperado" style="background: #008F5A;">
                        0
                    </div>
                </div>
                <div class="row my-1">
                    <div class="col-10 border-right rounded font-weight-bolder text-white info-label"  style="background: #2B2B29 ; ">
                        <i class="fas fa-cross mr-2"></i> Óbitos
                    </div>
                    <div class="col-2 text-center border-left rounded font-weight-bolder text-white info-count" id="obito" style="background: #2B2B29 ; ">
                        0
                    </div>
                </div>

                <div class="row my-1">
                    <div class="col-10 border-right rounded font-weight-bolder text-white info-label"  style="background: #BF3646 ; ">
                        <i class="fas fa-virus mr-2"></i> Em tratamento
                    </div>
                    <div class="col-2 text-center border-left rounded font-weight-bolder text-white info-count" id="tratamento" style="background: #BF3646 ; ">
                        0
                    </div>
                </div>
        </div>
        <a href="http://www.camboriu.ifc.edu.br/autoprotecao-social/">
            <img src="{{ asset('public/img/banner-social.png') }}"  class="card-img-top" >
        </a>
    </div>
</div>
