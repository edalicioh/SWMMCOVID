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
use App\Models\Profession;

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
                ->join('attendances', 'people.id', '=', 'attendances.person_id')
                ->leftJoin('districts' , 'addresses.district_id' ,'=' ,'districts.id')
                ->select('person_name', 'person_status', 'district_name', 'phone', 'person_id','discharge_date')
                ->where('excluded' ,'=' , null)
                ->get()->groupBy('person_id');
            foreach ($people as $key => $value) {
                $people[$key] = [
                    'person_name'           => $value[0]->person_name,
                    'district_name'         => $value[0]->district_name,
                    'phone'                 => $value[0]->phone,
                    'person_id'             => $value[0]->person_id,
                    'person_status'         => $this->validaStatus($value[0]->person_status),
                    'discharge_date'        => $value[0]->discharge_date
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
        $professions = Profession::all();
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
                'exams',
                'professions'
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
        $request->validate([
            'cpf' => "unique:people|nullable"
        ]);

        try {
            DB::beginTransaction();

            $all = $request->all();
            $all['address_id'] = (new AddressController())->store($request);
            $all['contaminations_id'] = (new ContaminationController())->store($request);
            $all['user_id'] =  Auth::user()->id;
            $data = $request->birth_date ? implode('-', array_reverse(explode('/', $request->birth_date))) : null;
            $all['birth_date'] = date('Y-m-d H:i:s', strtotime($data));
            $data = implode('-', array_reverse(explode('/', $request->first_medical_care)));
            $all['first_medical_care'] = date('Y-m-d H:i:s', strtotime($data));

            $all['patient'] = $all['patient'] ? true : false;

            $person = Person::create($all);

            $all['person_id'] = $person->id;
            $all['status_attendance'] = $all['person_status'];


            $discharge_date = $all['discharge_date'] ? implode('-', array_reverse(explode('/', $all['discharge_date']))) : null;
            $all['discharge_date']  = $discharge_date ? date('Y-m-d H:i:s', strtotime($discharge_date)) : null;

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
            dd($e);
            DB::rollBack();
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
            ->leftJoin('attendance_symptom', 'attendances.id', 'attendance_symptom.attendance_id')
            ->leftJoin('symptoms', 'attendance_symptom.symptom_id', 'symptoms.id')
            ->get()
            ->groupBy(['attendance_id']);

        foreach ($attendances as $Akey => $attendance) {
            $descricao = [];
            foreach ($attendance as $key => $value) {
                $descricao[] =  $value->description;
            }

            $attendances[$Akey] = [
                'date'          => $attendance[0]->date,
                'annotations'   => $attendance[0]->annotations,
                'attendance_id' => $attendance[0]->attendance_id,
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
        $professions = Profession::all();


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
                'diseases',
                'professions'
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
            (new AddressController())->update($request, $address);

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
        $person->excluded = 1;
        $person->update();
        toastr()->success('Excluido com Sucesso :)');
        return json_encode(true);
    }

    protected function validaStatus($status)
    {
        return Config::get('constants.STATUS')[$status];
    }
}
