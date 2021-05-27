<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [

            [

                'name'=>'Admin',

                'email'=>'admin@itsolutionstuff.com',

                'role'=>'1',

                'password'=> bcrypt('123456'),

            ],

            [

                'name'=>'User',

                'email'=>'user@itsolutionstuff.com',

                'role'=>'0',

                'password'=> bcrypt('123456'),

            ],

        ];



        foreach ($user as $key => $value) {

            User::create($value);

        }
    }
}
