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
            'name'=>'First Boss',
            'email' => 'firstboss@gmail.com',
            'password'=>bcrypt('12345678'),
            'phone'=>'0346459423',
            'role'=>1,
            'status'=>1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('users')->insert([
            'name'=>'First Staff',
            'email' => 'firststaff@gmail.com',
            'password'=>bcrypt('12345678'),
            'phone'=>'0341234343',
            'role'=>0,
            'status'=>1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        DB::table('partners')->insert([
            'name'=>'Tôi',
            'phone'=>'0346037872',
            'NCC'=>1,
            'NM'=>1,
            'car_owner' => 1,
            'created_at' => Carbon::now('Asia/Bangkok'),
            'updated_at' => Carbon::now('Asia/Bangkok'),
        ]);
        for ($x = 0; $x <= 9; $x++) {
            DB::table('partners')->insert([
                'name'=>'Partner_' . $x,
                'phone'=>'001201121' . $x,
                'NCC'=>1,
                'NM'=>1,
                'car_owner' => 1,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
        }
        for ($x = 0; $x <= 9; $x++) {
            DB::table('trucks')->insert([
                'plate'=>'3'. $x .'G-3234' . $x,
                'figure'=>'3 chân',
                'brand'=>'THACO',
                'capacity'=>24,
                'owner_id'=>($x+1),
                'status' => 1,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
          }
        for ($x = 0; $x <= 9; $x++) {
            DB::table('cost_groups')->insert([
                'name' => 'cost_group_' . $x,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
        }
        for ($x = 0; $x <= 9; $x++) {
            DB::table('categories')->insert([
                'name' => 'category_' . $x,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
        }
        for ($x = 0; $x <= 10; $x++) {
            DB::table('orders')->insert([
                'partner_id' => 1,
                'summary' => 'Đơn hàng thứ ' . ($x+1),
                'piority' => 0,
                'status' => 1,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
        }   
    }
}
