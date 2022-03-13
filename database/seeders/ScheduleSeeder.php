<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Truck;
use App\Models\Partner;
use App\Models\Category;
use App\Models\Order;
use Faker\Factory as Faker;

class ScheduleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $driversIDs = User::where('role', 0)->pluck('id');
        $trucksIDs= Truck::get()->pluck('id');   
        $carOwnersIDs = Partner::where('car_owner',1)->pluck('id');
        $start = strtotime('2018-01-01');
        $end = time();
        // \App\Models\User::factory(10)->create();
        for ($x = 0; $x <= 1000; $x++) {
            DB::table('schedules')->insert([
                'description' => "Công việc được tạo ngẫu nhiên bằng seeder cho mục đích test",
                'driver_id' => $faker->randomElement($driversIDs),
                'truck_id' => $faker->randomElement($trucksIDs),
                'car_owner_id' => $faker->randomElement($carOwnersIDs),
                'date' => date('Y-m-d',mt_rand($start, $end)),
                'shift' => rand(0, 1),
                'status' => 0,
                'init_money' => 4000000,
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
          }
    }
}
