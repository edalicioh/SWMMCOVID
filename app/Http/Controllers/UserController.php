<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('user_status', true)->get([
            'id',
            'user_name',
            'email'
        ]);
        return view('dashboard/pages/user/index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('dashboard/pages/user/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();
            $data = $request->all();

            User::create([
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'companies_id' => 1
            ]);

            DB::commit();

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/users');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function edit(User  $user)
    {
        $user = [
            'id' => $user->id,
            'email' => $user->email,
            'user_name' => $user->user_name
        ];

        return view('dashboard/pages/user/create', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {


        $request->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string',  'max:255', 'email', 'unique:users,email,' . $user->id . ',id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        try {
            DB::beginTransaction();


            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);


            $user->update();

            DB::commit();

            toastr()->success('Dados Salvo com Sucesso :)');
            return redirect('/admin/users');
        } catch (\Exception $e) {
            dd($e);
            DB::rollBack();
            toastr()->error('Erro ao salvar os dados :/ ');
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->user_status = false;
        $user->update();
        return json_encode(true);
    }
}
