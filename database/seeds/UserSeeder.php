<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*, ; ; r.bw@hotmail.com;

                Juliana => r.bw@hotmail.com,
                Cleonice => cleonice.beppler@ifc.edu.br,
                Adelson => adelsonbc@gmail.com,
                Leandro => leandro.mondini@ifc.edu.br,
        */
        $users = [
            [
                'user_name' => 'Edalicio',
                'email' => 'edalicio@outlook.com',
                'password' => bcrypt('edalicio'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
        ];

        User::insert( $users);
    }
}
