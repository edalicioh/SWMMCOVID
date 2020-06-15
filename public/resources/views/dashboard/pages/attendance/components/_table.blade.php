<div class="card card-info card-outline">
    <div class="card-body">
        <div class="row">
            <table  class="table table-striped table-responsive">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Resultado do Exame</th>
                        <th>Anotações</th>
                        <th>Sintomas</th>
                        <th>Doenças</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $key => $attendance)

                        <tr>
                            <td>{{  date( 'd/m/Y h:i' , strtotime( $attendance['date']))  }}</td>
                            <td class="text-uppercase">{{ validateExam( $attendance['exam_status'] ) }}</td>
                            <td>{{  $attendance['annotations'] }}</td>
                            <td class="text-uppercase">{{ $attendance['symptoms'] }}</td>
                            <td class="text-uppercase">{{  $attendance['diseases'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    function validateExam($exam)
    {
        return Config::get('constants.ATTENDANCES')[$exam];
    }
?>
