<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attendance;
use App\Models\District;
use App\Models\Exam;
use App\Models\Person;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use SimpleXLSX;

class CsvController extends Controller
{
    public function create()
    {
        return view('dashboard/pages/csv/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        try {

            $file = $request->file('csv_file');


            if ( $xlsx = SimpleXLSX::parse( $file  )) {
                $header_values = $rows = [];
                foreach ( $xlsx->rows() as $k => $r ) {
                    if ( $k === 0 ) {
                        $header_values = $r;

                        continue;
                    }
                    $rows[] = array_combine( $header_values, $r );
                }
            }
            foreach ($rows as $key => $dados) {
                DB::beginTransaction();
                $rua = '';
                $numero = '';
                $ob = '';
                $bairroId = '';
                $cidadeId = '';
                $person = '';

                $where = [];
                $newPersona = false;
                $updatePersona = false;
                $dateDeath = null;


                    $dados['idade']     = $dados['idade'] && $dados['idade'] != "Não informado" && $dados['idade'] != "" ? $dados['idade']  : 0;
                    $dados['CPF']       = $dados['CPF']  ? $dados['CPF'] : null;
                    $dados['status']    = $dados['status'] ? $this->validaStatus($dados['status']) : 0;


                    $where[] = ['person_name','=' ,$dados['nome'] ];
                    $where[] = ['age','=' ,$dados['idade'] ];


                    $person = DB::table('people')
                        ->where($where)
                        ->get();



                    if (count($person) > 0) {
                        if ($dados['CPF'] != '' && $person[0]->cpf == '') {
                            Person::find($person[0]->id)->update(['cpf' => $dados['CPF']]);
                        } else if ($dados['CPF'] == $person[0]->cpf) {
                            $updatePersona = true;
                        }
                    } else {
                        if ($dados['CPF'] != '') {
                            $personCpf = DB::table('people')->where('cpf','=' ,$dados['CPF'] )->get();

                            if (count($personCpf) == 0) {
                                $newPersona  = true;
                            }
                        } else {
                            $newPersona  = true;
                        }
                    }




                    if ($newPersona) {

                        if ($dados['endereco']) {
                            $end = explode(', ', $dados['endereco']);

                            $rua = $end[0];
                            if (isset($end[1])) {
                                $num = $end[1] != 's/n' ? explode(' ', $end[1]) : false;
                                if ($num) {
                                    $numero = intval($num[0]);
                                    array_shift($num);
                                    $ob = implode(' ', $num);
                                } else {
                                    $numero = 00;
                                }
                            } else {
                                $numero = 00;
                            }
                        } else {
                            $rua = '00';
                            $numero = 00;
                        }


                        if ($dados['bairro']) {

                            $s = District::where('district_name', 'LIKE', '%' . $dados['bairro'] . '%')->get();

                            if (count($s) > 0) {
                                $bairroId = $s[0]->id;
                                $cidadeId = $s[0]->city_id;
                            } else {
                                $s = District::where('district_name', 'LIKE', '%' . 'Não informado' . '%')->get();
                                $bairroId = $s[0]->id;
                                $cidadeId = $s[0]->city_id;
                            }
                        } else {
                            $s = District::where('district_name', 'LIKE', '%' . 'Não informado' . '%')->get();
                            $bairroId = $s[0]->id;
                            $cidadeId = $s[0]->city_id;
                        }

                        $address = new Address();
                        $address->street = $rua;
                        $address->number = $numero;
                        $address->observation = $ob;
                        $address->state_id = 1;
                        $address->city_id = $cidadeId;
                        $address->district_id = $bairroId;
                        $address->save();
                        $addressId = $address->id;

                        if($dados['status']  == 6) {
                            $dataObito = explode(' ', $dados['aconpanhamento'])[1];
                            $data = explode('/', $dataObito);
                            $data[] = "2020";
                            $data  = "$data[2]-$data[1]-$data[0]";
                            $dateDeath = date('Y-m-d H:i:s', strtotime($data));
                        }



                        $all = [
                            'person_name' => $dados['nome'] ? $dados['nome'] : 'Não informado',
                            'gender' => $dados['sexo'] ? $dados['sexo'] : 'O',
                            'age' => $dados['idade'] && $dados['idade'] != "Não informado" && $dados['idade'] != "" ? intval($dados['idade']) : 0,
                            'phone' => $dados['telefone'] && $dados['telefone'] != "Não informado" ? $dados['telefone'] : null,
                            'cpf' => $dados['CPF']  ? $dados['CPF'] : null,
                            'work_status' => 1,
                            'patient' => 1,
                            'person_status' => $dados['status'] ,
                            'first_medical_care' => $dados['data_sintomas'] ? $dados['data_sintomas'] : null,
                            'address_id' => $addressId,
                            'date_death' => $dateDeath,
                            'user_id' => Auth::user()->id,
                        ];

                        $per = Person::create($all);

                        $this->attendance($dados, $per);
                        $this->exam($dados, $per);

                    }

                    if ($updatePersona) {
                        $status = '';
                        $status = $dados['status'];

                        if ($person[0]->person_status != $status && $person[0]->person_status != 6 ){
                            
                            $this->attendance($dados, $person[0]);
                            $this->exam($dados, $person[0]);

                            $pe = Person::find($person[0]->id);
                            $pe->update(['person_status' => $status]);
                            //dd($person) ;
                        }
                    }

                DB::commit();
            }

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    protected function validaExm($status)
    {
        switch ($status) {
            case 'não detectável':
                return 1;
            case 'confirmado':
                return 2;
            case 'confirmado - TR':
                return 2;
            case 'Aguardando':
                return 3;
            default:
                return 4;
        }
    }

    protected function validaStatus($status)
    {
        switch ($status) {
            case 'tratamento':
                return 4;

            case 'alta':
                return 5;

            case 'óbito':
                return 6;

            case 'Óbito':
                return 6;

            default:
                return 0;
        }
    }

    protected function attendance($dados, $person)
    {
        $atte = [
            'date' => $dados['data'] ? $dados['data'] : null,
            'exam_result' => $dados['resultado_laboratorial'] ? $this->validaExm($dados['resultado_laboratorial']) : 4,

            'status_attendance' => $dados['status'] ? $this->validaStatus($dados['status']) : 0,
            'discharge_date' =>  $dados['data_alta'] ? $dados['data_alta'] : null,
            'person_id' => $person->id,
        ];



        $attendance = Attendance::create($atte);


        $sintomas = explode(', ', $dados['sintomas']);
        $ass = [];
        foreach ($sintomas as $Skey => $sintoma) {
            $sintoma = Symptom::where('symptom_description', 'LIKE', '%' . $sintoma . '%')->get();


            if (isset($sintoma[0])) {
                $ass[] = $sintoma[0]->id;
            }
        }
        $attendance->symptoms()->sync($ass);
    }
    public function exam($dados,$person)
    {
     //   'collection_date', 'result_date',  'exam_status', 'person_id' , 'collection_id'
        $exam = [
            'result_date' => $dados['data_resultado'] ? $dados['data_resultado'] : null,
            'exam_status' => $dados['resultado_laboratorial'] ? $this->validaExm($dados['resultado_laboratorial']) : 4,
            'person_id' => $person->id,
        ];

        Exam::create($exam);

    }
}
