<?php

use Illuminate\Database\Seeder;
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
         User::create([
            'name' => 'Robin',
            'email' => 'robin.trejos@peoplecontact.com.co',
            'password' => bcrypt('123456'),
            'USR_APELLIDOS' => 'Trejos',
            'USR_DOCUMENTO' => '75075075',
            'USR_ESTADO' => 1,
            'USR_TELEFONO' => '8818181'
        ]);
    }
}
