<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name'=>'santiago',
            'email'=>'santy@gmail.com',
            'password'=>Hash::make('12345678'),
        ]);

        DB::table('users')->insert([
            'name'=>'Viviana',
            'email'=>'vivi@gmail.com',
            'password'=>Hash::make('12345678'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ]);
    }
}
