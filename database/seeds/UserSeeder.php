<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
        [
            'name' => 'Donna Joy Tilos',
            'email' => 'donna@gmail.com',
            'role' => 'operator',
            'password' => Hash::make('donna')
        ],[
            'name' => 'Rey Eduard Torres',
            'email' => 'rey@gmail.com',
            'role' => 'technician',
            'password' => Hash::make('torres')
        ],[
            'name' => 'Arvin Ramos',
            'email' => 'arvin@gmail.com',
            'role' => 'supervisor',
            'password' => Hash::make('arvin')
        ]]);
    }
}
