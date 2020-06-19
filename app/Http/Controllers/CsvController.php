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
            foreach ($data as $key => $value) {


                $rua = '';
                $numero = '';
                $ob = '';
                $bairroId = '';
                $cidadeId = '';

                if ($value[1] == '') {
                    $cont++;
                }
                if ($key > 7) {
                    $person = Person::where('person_name', '=', $value[1])->get();
                    if (count($person) == 0) {
                        if ($value[4]) {
                            $end = explode(', ', $value[4]);

                            $rua = $end[0];
                            if (isset($end[1])) {
                                $num = $end[1] != 's/n' ? explode(' ', $end[1]) : false;
                                if ($num) {
                                    $numero = intval($num[0]);
                                    array_shift($num);
                                    $ob =  implode(' ', $num);
                                } else {
                                    $numero = 00;
                                }
                            } else {
                                $numero  = 00;
                            }
                        } else {
                            $rua = '00';
                            $numero  = 00;
                        }


                        if ($value[5]) {

                            $s = District::where('district_name', 'ILIKE', '%' . $value[5] . '%')->get();

                            if (count($s) > 0) {
                                $bairroId = $s[0]->id;
                                $cidadeId = $s[0]->city_id;
                            } else {
                                $s = District::where('district_name', 'ILIKE', '%' . 'nao tem' . '%')->get();
                                $bairroId = $s[0]->id;
                                $cidadeId = $s[0]->city_id;
                            }
                        } else {
                            $s = District::where('district_name', 'ILIKE', '%' . 'nao tem' . '%')->get();
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

                        $all = [
                            'person_name' =>  $value[1] ? $value[1] : 'nao informado',
                            'gender' => $value[2] ? $value[2] : 'O',
                            'age' => $value[3] && $value[3] != "Não informado" && $value[3] != ""  ? intval($value[3]) : 00,
                            'phone' => $value[6] && $value[6] != "Não informado" ? $value[6] : '00',
                            'work_status' => 1,
                            'patient' => 1,
                            'person_status' => $value[12] ? $this->validaStatus($value[12]) : 4,
                            'first_medical_care' => $value[7] && $value[7] != "******" && $value[7] != "Não informado" ? $value[7] : date('Y-m-d H:i:s'),
                            'address_id' => $addressId,
                            'user_id' =>  Auth::user()->id,
                        ];

                        $person = Person::create($all);

                        $atte = [
                            'date' => $value[0] ? $value[0] : date('Y-m-d H:i:s'),
                            'exam_result' => $this->validaStatus($value[12]),
                            'person_id' => $person->id,
                        ];

                        $attendance = Attendance::create($atte);


                        $sintomas =  explode(', ', $value[8]);
                        foreach ($sintomas as $Skey => $sintoma) {
                            $sintoma = Symptom::where('symptom_description', 'ILIKE', '%' . $sintoma . '%')->get();
                            if (isset($sintoma[0])) {

                                $attendance->symptoms()->sync($sintoma[0]->id);
                            }
                        }
                    }
                }

                if ($cont > 5) {
                    break;
                }
            }
            DB::commit();

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');
        } catch (\Exception $e) {
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

    protected function validaStatus($status)
    {
        switch ($status) {
            case 'não detectável':
                return 1;
            case 'confirmado':
                return 2;
            default:
                return 4;
        }
    }
}
