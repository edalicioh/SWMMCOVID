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



        $users = [
            [
                'user_name' => 'Edalicio Heinzen',
                'email' => 'edalicio@outlook.com',
                'password' => bcrypt('admin'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Juliana Chayanne de Oliveira',
                'email' => 'r.bw@hotmail.com',
                'password' => bcrypt('juliana'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Cleonice',
                'email' => 'cleonice.beppler@ifc.edu.br',
                'password' => bcrypt('cleonice'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Adelson',
                'email' => 'adelsonbc@gmail.com',
                'password' => bcrypt('adelson'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Amanda Thais da Costa',
                'email' => 'amandathais@gmail.com',
                'password' => bcrypt('amanda'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Núbia Cantalixto de Melo Alves',
                'email' => 'cantalixto@gmail.com',
                'password' => bcrypt('cantalixto'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Margarete Cadore',
                'email' => 'margaretecadore@gmail.com',
                'password' => bcrypt('margarete'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
            [
                'user_name' => 'Patricia Ferraz',
                'email' => 'patriciaferraz96@homail.com',
                'password' => bcrypt('patriciaferraz'),
                'companies_id' =>  DB::table('companies')->pluck('id')[0]
            ],
        ];


        User::insert( $users);
    }
}
