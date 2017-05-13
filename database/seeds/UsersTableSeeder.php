<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'phamha.test@gmail.com',
            'id_role' => 1,
            'password' => bcrypt('secret'),
            'id_department' => 1,
        ]);

        factory(User::class, 20)->create();
    }
}
