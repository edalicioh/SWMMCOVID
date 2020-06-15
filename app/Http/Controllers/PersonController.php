<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Attendence;
use App\Models\Disease;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreUpdade;
use App\Models\Attendance;
use App\Models\CollectionLocation;
use App\Models\Company;
use App\Models\Exam;
use App\Models\Hospital;

class PersonController extends Controller
{
    public function __construct(Person $person)
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {

            $people = DB::table('people')
                ->join('addresses', 'people.address_id', '=', 'addresses.id')
                ->rightJoin('attendances', 'people.id', '=', 'attendances.person_id')
                ->leftJoin('districts', 'addresses.district_id', '=', 'districts.id')
                ->select('person_name', 'cpf', 'person_status', 'district_name', 'phone', 'person_id')
                ->get()->groupBy('person_id');

            foreach ($people as $key => $value) {
                $people[$key] = [
                    'person_name'        => $value[0]->person_name,
                    'cpf'         => $value[0]->cpf,
                    'district_name' => $value[0]->district_name,
                    'phone'        => $value[0]->phone,
                    'person_id'     => $value[0]->person_id,
                    'person_status'        => $this->validaStatus($value[0]->person_status)
                ];
            }


            return DataTables::of($people)->make(true);
        }

        return view('dashboard/pages/person/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $districts  = DB::table('districts')->get();
        $cities     = DB::table('cities')->get();
        $states     = DB::table('states')->get();
        $symptoms   = DB::table('symptoms')->get();
        $indicadors = DB::table('indicadors');
        $diseases   = Disease::get();
        $hospitais  = Hospital::get();
        $companies  = Company::get();
        $exams      = CollectionLocation::get();


        return view(
            'dashboard/pages/person/create',
            compact([
                'districts',
                'cities',
                'states',
                'indicadors',
                'symptoms',
                'diseases',
                'hospitais',
                'companies',
                'exams'
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {

        try {
            DB::beginTransaction();

            $all = $request->all();
            $all['address_id'] = (new AddressController())->store($request);
            $all['contaminations_id'] = (new ContaminationController())->store($request);
            $all['user_id'] =  Auth::user()->id;
            $data = implode('-', array_reverse(explode('/', $request->birth_date)));
            $all['birth_date'] = date('Y-m-d H:i:s', strtotime($data));
            $data = implode('-', array_reverse(explode('/', $request->first_medical_care)));
            $all['first_medical_care'] = date('Y-m-d H:i:s', strtotime($data));

            $all['patient'] = $all['patient'] ? true : false;

            $person = Person::create($all);

            $all['person_id'] = $person->id ;
            $all['status_attendance'] = $all['person_status'];

            $exp = explode(' ', $all['date']);
            $data = implode('-', array_reverse(explode('/', $exp[0]))) . ' ' . $exp[1];


            $all['date'] = date('Y-m-d H:i:s', strtotime($data));

            $attendance = Attendance::create($all);



            if ($request->symptoms != 'null') {
                $attendance->symptoms()->sync($request->symptoms);
            }

            if ($request->diseases != 'null') {
                $attendance->diseases()->sync($request->diseases);
            }


            DB::commit();

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
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */

    public function edit(Person $person)
    {

        $address = $person->address()
            ->first();

        $attendances = $person->attendances()
            ->leftJoin('attendence_symptom', 'attendences.id', 'attendence_symptom.attendence_id')
            ->leftJoin('symptoms', 'attendence_symptom.symptom_id', 'symptoms.id')
            ->select('date', 'annotations', 'attendence_id', 'description', 'exam')
            ->get()
            ->groupBy(['attendence_id']);

        foreach ($attendances as $Akey => $attendance) {
            $descricao = [];
            foreach ($attendance as $key => $value) {
                $descricao[] =  $value->description;
            }

            $attendances[$Akey] = [
                'date'          => $attendance[0]->date,
                'annotations'   => $attendance[0]->annotations,
                'attendence_id' => $attendance[0]->attendence_id,
                'exam'          => $attendance[0]->exam,
                'symptoms' => implode(', ', $descricao)
            ];
        }

        $districts = DB::table('districts')->get();
        $cities = DB::table('cities')->get();
        $states = DB::table('states')->get();
        $symptoms = DB::table('symptoms')->get();
        $indicadors = DB::table('indicadors');
        $diseases = Disease::get();


        return view(
            'dashboard/pages/person/create',
            compact([
                'person',
                'address',
                'attendances',
                'districts',
                'cities',
                'states',
                'indicadors',
                'symptoms',
                'diseases'
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        try {

            DB::beginTransaction();

                $address = Address::where('id',  $person->address_id)->first();
                (new AddressController())->update($request,$address);

                $person->gender         = $request->gender;
                $person->phone          = $request->phone;
                $person->age            = $request->age;
                $person->work_status    = $request->work_status;
                $person->update();

            DB::commit();
            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        //
    }

    protected function validaStatus($status)
    {
        return Config::get('constants.STATUS')[$status];
    }
}
