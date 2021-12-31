<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::table('users')->insert([
            'name'=>'admin',
            'email' => 'admin@admin.com',
            'password'=>bcrypt('admin'),
            'phone'=>'0356037873',
            'role'=>2,
            'status'=>1,
        ]);
        DB::table('users')->insert([
            'name'=>'Pham Tu',
            'email' => 'firstboss@gmail.com',
            'password'=>bcrypt('12345678'),
            'phone'=>'0346459423',
            'role'=>1,
            'status'=>1,
        ]);
        DB::table('partners')->insert([
            'name'=>'Pham Tu',
            'phone'=>'0346459423',
            'NCC'=>1,
            'NM'=>1,
            'car_owner' => 1,
        ]);
    }
}
