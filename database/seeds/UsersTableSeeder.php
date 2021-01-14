<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('email','takusuzu601@gmail.com')->first();

        if(!$user){
            User::create([
                'name'=>'takusuzu',
                'email'=>'takusuzu601@gmail.com',
                'role'=>'admin',
                'password'=>Hash::make('password'),
            ]);
        }
    }
}
