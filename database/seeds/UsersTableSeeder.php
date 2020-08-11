<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::where('email','sandeshgautam876gmail.com')->first();

       if(!$user){
           User::create([
               'name'=>'Sandesh',
               'email'=>'sandeshgautam876@gmail.com',
               'role' => 'admin',
               'password'=>Hash::make('hello123')
           ]);
       }
    }
}
