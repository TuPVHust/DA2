<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('users')->insert([
            'name'=>'Pham Boss Tu',
            'email' => 'firstboss@gmail.com',
            'password'=>bcrypt('12345678'),
            'phone'=>'0346459423',
            'role'=>1,
            'status'=>1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('users')->insert([
            'name'=>'Pham Staff Tu',
            'email' => 'firststaff@gmail.com',
            'password'=>bcrypt('12345678'),
            'phone'=>'0341234343',
            'role'=>0,
            'status'=>1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('partners')->insert([
            'name'=>'Pham Tu',
            'phone'=>'0346459423',
            'NCC'=>1,
            'NM'=>1,
            'car_owner' => 1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('trucks')->insert([
            'plate'=>'30G-32342',
            'figure'=>'3 chân',
            'brand'=>'THACO',
            'capacity'=>24,
            'owner_id'=>1,
            'status' => 1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('cost_groups')->insert([
            'name' => 'khác',
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('categories')->insert([
            'name' => 'cát',
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('orders')->insert([
            'partner_id' => 1,
            'summary' => 'Đơn hàng đầu tiên',
            'piority' => 0,
            'status' => 1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
    }
}
