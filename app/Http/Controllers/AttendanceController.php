<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CollectionLocation;
use App\Models\Person;
use App\Models\Disease;
use App\Models\Hospital;
use App\Models\Symptom;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     */
    public function index(Person $person)
    {
            $diseases = $person->attendances()
                ->join('attendance_disease', 'attendances.id','=' , 'attendance_disease.attendance_id')
                ->leftJoin('diseases', 'attendance_disease.disease_id','=' , 'diseases.id')
                ->distinct()
                ->get()
                ->groupBy('attendance_id');
            $symptoms = $person->attendances()
                ->join('attendance_symptom', 'attendances.id','=' ,'attendance_symptom.attendance_id')
                ->leftjoin('symptoms', 'attendance_symptom.symptom_id','=' , 'symptoms.id')
                ->distinct()
                ->get()
                ->groupBy('attendance_id');

                $attendances = $person->attendances()->get()->groupBy('id');


                foreach ($attendances as $key => $attendance ) {
                    $symptomDescription = [];
                    $diseasesDescription = [];
                    if (isset($symptoms[$key])) {

                        foreach ($symptoms[$key]  as $Skey => $value) {

                            if( !in_array( $value->symptom_description, $symptomDescription) ){
                                $symptomDescription[] =  $value->symptom_description;
                            }

                        }
                    }
                    if (isset($diseases[$key] )) {

                        foreach ($diseases[$key]  as $Dkey => $value) {

                            if( !in_array( $value->disease_description, $diseasesDescription) ){

                                $diseasesDescription[] =  $value->disease_description;
                            }

                        }
                    }

                    $attendances[$key] = [
                        'date'                  => $attendance[0]->date,
                        'annotations'           => $attendance[0]->annotations,
                        'attendance_id'         => $key,
                        'exam_result'           => $attendance[0]->exam_result,
                        'symptoms'              => implode(', ', $symptomDescription),
                        'diseases'              => implode(', ', $diseasesDescription)

                    ];
                }
        return view('dashboard/pages/attendance/index', compact(['person' , 'attendances']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @param  \App\Models\Person  $person
     */

    public function create(Person $person)
    {
        $symptoms   = Symptom::all();
        $diseases   = Disease::all();
        $hospitais  = Hospital::all();
        $exams      = CollectionLocation::get();


        return view('dashboard/pages/attendance/create',
        compact('person','symptoms','diseases','exams','hospitais') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request, $isNew = false)
    {

        try {

            DB::beginTransaction();
            $all = $request->all();
            $all['person_id'] = $request->person_id ;

            $exp = explode(' ', $all['date']);
            $data = implode('-', array_reverse(explode('/', $exp[0]))) . ' ' . $exp[1];
            $all['date'] = date('Y-m-d H:i:s', strtotime($data));

            $discharge_date = implode('-', array_reverse(explode('/', $all['discharge_date'])));
            $all['discharge_date']  = date('Y-m-d H:i:s', strtotime($discharge_date));


            $attendance = Attendance::create($all);

            if ($request->symptoms != 'null') {
                $attendance->symptoms()->sync($request->symptoms);
            }

            if ($request->diseases != 'null') {
                $attendance->diseases()->sync($request->diseases);
            }

            if ($isNew) {
                DB::commit();
                return $attendance;
            }

            $person = Person::where('id' , $request->person_id )->get()[0];

            if ( ( $person->patient != $request->patient )||( $person->person_status != $request->person_status)) {
                $person->patient = $request->patient;
                $person->person_status = $request->person_status;
                $person->update();
            }

            DB::commit();

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/person');

        } catch (\Exception $e) {
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        return view('dashboard/pages/attendance/create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
