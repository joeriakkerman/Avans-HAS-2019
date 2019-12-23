<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('nl_NL');

            DB::table('route')->insert([
                'name' => 'Kastelen en Abdijen',
                'length' => 42.55,
            ]);
            DB::table('route')->insert([
            'name' => 'Oirschotse Route',
            'length' => 3.83,
             ]);
            DB::table('route')->insert([
            'name' => 'Boxtelse Route',
            'length' => 5.22,
            ]);

        DB::table('route')->insert([
            'name' => 'De Waterhoefse route',
            'length' => 1.2,
        ]);

        DB::table('route')->insert([
            'name' => 'Landschotse Heide Route',
            'length' => 3.95,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '13',
            'route_id' => 1,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '15',
            'route_id' => 1,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '21',
            'route_id' => 1,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '18',
            'route_id' => 2,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '26',
            'route_id' => 2,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '4',
            'route_id' => 2,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '24',
            'route_id' => 3,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '17',
            'route_id' => 3,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '28',
            'route_id' => 3,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '13',
            'route_id' => 4,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '7',
            'route_id' => 4,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '19',
            'route_id' => 5,
        ]);

        DB::table('route_has_interest_point')->insert([
            'point_id' => '14',
            'route_id' => 5,
        ]);
    }
}
