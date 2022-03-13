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
use App\Models\Schedule;
use Faker\Factory as Faker;

class ScheduleDetailSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $sellersIDs = Partner::where('NCC', 1)->pluck('id');
        $buyersIDs= Partner::where('NM', 1)->pluck('id'); 
        $ordersIDs=Order::get()->pluck('id'); ;
        $categoriesIDs= Category::get()->pluck('id');  
        $schedulesIDs= Schedule::get()->pluck('id');    
        $start = strtotime('2018-01-01');
        $end = time();
        for ($x = 0; $x <= 2500; $x++) {
            DB::table('schedule_details')->insert([
                'description' => 'Chuyến tạo ngẫu nhiên từ seeder',
                'seller_id' => $faker->randomElement($sellersIDs),
                'buyer_id' => $faker->randomElement($buyersIDs),
                'order_id' => $faker->randomElement($ordersIDs),
                'category_id' => $faker->randomElement($categoriesIDs),
                'price' => rand(15, 25)*100000,
                'actual_price' => rand(15, 25)*100000,
                'revenue' => rand(20, 35)*100000,
                'actual_revenue' => rand(20, 35)*100000,
                'quantity' => rand(20, 35),
                'distance' => rand(20, 35)*100000,
                'schedule_id' => $faker->randomElement($schedulesIDs),
            ]);
        }
        // \App\Models\User::factory(10)->create();
        for ($x = 0; $x <= 500; $x++) {
            DB::table('schedule_details')->insert([
                'description' => 'Chuyến tạo ngẫu nhiên từ seeder',
                'seller_id' => $faker->randomElement($sellersIDs),
                'buyer_id' => $faker->randomElement($buyersIDs),
                'order_id' => null,
                'category_id' => $faker->randomElement($categoriesIDs),
                'price' => rand(15, 25)*100000,
                'actual_price' => rand(15, 25)*100000,
                'revenue' => rand(20, 35)*100000,
                'actual_revenue' => rand(20, 35)*100000,
                'quantity' => rand(20, 35),
                'distance' => rand(20, 35)*100000,
                'schedule_id' => $faker->randomElement($schedulesIDs),
            ]);
        }
    }
}
