<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Schedule;
use App\Models\CostGroup;
use Faker\Factory as Faker;

class CostDetailSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $schedulesIDs= Schedule::get()->pluck('id');    
        $costGroupsIDs= CostGroup::get()->pluck('id');    
        $start = strtotime('2018-01-01');
        $end = time();
        // \App\Models\User::factory(10)->create();
        for ($x = 0; $x <= 2000; $x++) {
            DB::table('cost_details')->insert([
                'description' => 'Chi phí được tạo ngẫu nhiên bằng seeder',
                'cost' => rand(1, 5)*100000,
                'actual_cost' => rand(1, 5)*100000,
                'schedule_id' => $faker->randomElement($schedulesIDs),
                'cost_group_id' => $faker->randomElement($costGroupsIDs),
                'created_at' => Carbon::now('Asia/Bangkok'),
                'updated_at' => Carbon::now('Asia/Bangkok'),
            ]);
          }
    }
}
