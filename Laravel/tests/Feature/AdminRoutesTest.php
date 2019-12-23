<?php

namespace Tests\Feature;

use App\Models\ProjectPoint;
use App\Models\Route;
use Tests\TestCase;
use Faker as Faker;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminRoutes extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test * */
    public function test_admin_can_get_interest_points()
    {
        $interestPoints = factory(ProjectPoint::class)->create();

        $found = $interestPoints::findOrFail($interestPoints->id);
        $count = $interestPoints::all();

        $this->assertInstanceOf(ProjectPoint::class, $found); //Checks if it is the projectpoint model
        $this->assertGreaterThan(0, count($count)); //Checks if its filled
    }

    /** @test * */
    public function test_admin_can_insert_routes()
    {
        $faker = Faker\Factory::create();

        $data = [
            'name' => $faker->name,
            'length' => $faker->randomDigit,
        ];

        $route = Route::create($data);

        $this->assertInstanceOf(Route::class, $route); //Checks if it is the Route model
        $this->assertEquals($data['name'], $route->name); //Checks if the name is the same in the database
        $this->assertEquals($data['length'], $route->length); //Checks if the length is the same in the database
    }

    public function test_admin_can_show_routes()
    {
        $routes = factory(Route::class)->create();
        $found = $routes::findOrFail($routes->id);

        $this->assertInstanceOf(Route::class, $found);

        $this->assertEquals($found->name, $routes->name);
        $this->assertEquals($found->length, $routes->length);
    }

    public function test_admin_can_update_routes()
    {
        $faker = Faker\Factory::create();
        $routes = factory(Route::class)->create();

        $data = [
            'name' => $faker->name,
            'length' => $faker->randomDigit,
        ];

        $update = $routes->update($data);

        $this->assertTrue($update);
        $this->assertEquals($data['name'], $routes->name);
        $this->assertEquals($data['length'], $routes->length);
    }
}
