<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attendance;
use App\Models\District;
use App\Models\Person;
use App\Models\Symptom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
            $file = $request->file('csv_file');
            $path = $file->getRealPath();
            $data = array_map('str_getcsv', file($path));

            $cont = 0;
            //dd($data[0]);

            foreach ($data as $key => $value) {

                $rua = '';
                $numero = '';
                $ob = '';
                $bairroId = '';
                $cidadeId = '';


                if ($key > 0) {
                    $dados = [
                        "data"                      => $value[0],
                        "nome"                      => $value[1],
                        "sexo"                      => $value[2],
                        "idade"                     => $value[3],
                        "endereco"                  => $value[4],
                        "bairro"                    => $value[5],
                        "telefone"                  => $value[6],
                        "data_sintomas"             => $value[7],
                        "sintomas"                  => $value[8],
                        "Comorbidade"               => $value[9],
                        "profissao"                 => $value[10],
                        "observaoes"                => $value[11],
                        "coleta"                    => $value[12],
                        "resultadoLaboratorial"     => $value[13],
                        "dataInformacaoResultado"   => $value[14],
                        "aconpanhamento"            => $value[15],
                        "data_alta"                 => $value[16],
                        "status"                    => $value[17],
                    ];

                    $person = Person::where('person_name', '=', $dados['nome'])->get();
                    if (count($person) == 0) {
                        if ($dados['endereco']) {
                            $end = explode(', ', $dados['endereco']);

                            $rua = $end[0];
                            if (isset($end[1])) {
                                $num = $end[1] != 's/n' ? explode(' ', $end[1]) : false;
                                if ($num) {
                                    $numero = intval($num[0]);
                                    array_shift($num);
                                    $ob = implode(' ', $num);
                                }
                                else {
                                    $numero = 00;
                                }
                            }
                            else {
                                $numero = 00;
                            }
                        }
                        else {
                            $rua = '00';
                            $numero = 00;
                        }


                        if ($dados['bairro']) {

                            $s = District::where('district_name', 'LIKE', '%' . $dados['bairro'] . '%')->get();

                            if (count($s) > 0) {
                                $bairroId = $s[0]->id;
                                $cidadeId = $s[0]->city_id;
                            }
                            else {
                                $s = District::where('district_name', 'LIKE', '%' . 'Não informado' . '%')->get();
                                $bairroId = null;
                                $cidadeId = null;
                            }
                        }
                        else {
                            $s = District::where('district_name', 'LIKE', '%' . 'Não informado' . '%')->get();
                            $bairroId = null;
                            $cidadeId = null;
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

                        $all = [
                            'person_name' => $dados['nome'] ? $dados['nome'] : 'Não informado',
                            'gender' => $dados['sexo'] ? $dados['sexo'] : 'O',
                            'age' => $dados['idade'] && $dados['idade'] != "Não informado" && $dados['idade'] != "" ? intval($dados['idade']) : 0,
                            'phone' => $dados['telefone'] && $dados['telefone'] != "Não informado" ? $dados['telefone'] : null,
                            'work_status' => 1,
                            'patient' => 1,
                            'person_status' => $dados['status'] ? $this->validaStatus($dados['status']) : 0,
                            'first_medical_care' => $dados['data_sintomas'] ? date('Y-m-d H:i:s', strtotime($dados['data_sintomas'])) : null,
                            'address_id' => $addressId,
                            'user_id' => Auth::user()->id,
                        ];
                        $person = Person::create($all);

                        $this->attendance($dados , $person);

                    }
                    else if (count($person) == 1) {
                        $att = Attendance::where('date', date('Y-m-d H:i:s', strtotime($dados['data'])))->get();

                        if(count($att) == 0){

                            $all = [
                                'patient' => 1,
                                'person_status' => $dados['status'] ? $this->validaStatus($value['status']) : 0,
                            ];

                            Person::where('id', $person[0]->id)->update($all);

                            $this->attendance($dados , $person);

                        }
                    }
                }
            }


            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');
        }
        catch (\Exception $e) {
            dd($e);
            DB::rollBack();
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
            default:
                return 4;
        }
    }

    protected function validaStatus($status)
    {
        switch ($status) {
            case 'isolamento':
                return 4;
            case 'alta':
                return 5;
            case 'óbito':
                return 6;
            case 'Óbito':
                return 6;
            case 'uti':
                return 2;
            case 'enfermaria':
                return 2;
            default:
                return 0;
        }
    }

    protected function attendance($dados, $person )
    {
        $atte = [
            'date' => $dados['data'] ? date('Y-m-d H:i:s', strtotime($dados['data'])) : null,
            'exam_result' => $dados['resultadoLaboratorial'] ? $this->validaExm($dados['resultadoLaboratorial']) : 4,
            'status_attendance' => $dados['status'] ? $this->validaStatus($dados['status']) : 0,
            'discharge_date' =>  $dados['data_alta'] ? date('Y-m-d H:i:s', strtotime($dados['data_alta'])) : null ,
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


}
