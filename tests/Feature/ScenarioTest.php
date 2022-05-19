<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

class ScenarioTest extends TestCase
{
    /**
     * Get env token
     */
    public function getToken()
    {
        App::loadEnvironmentFrom('.env');
        return env('DUMMY_TOKEN');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_scenario_one_success_response()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json',
        ])->getJson('/api/question/one');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_scenario_two_fail_without_parameter()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json',
        ])->getJson('/api/question/two');

        $response->assertStatus(400);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_scenario_two_success_response()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json',
        ])->getJson('/api/question/two?type=console');

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_scenario_types_success_response()
    {
        $response = $this->getJson('/api/types');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_success_response()
    {
        App::loadEnvironmentFrom('.env');
        $user = env('DUMMY_USER');
        $response = $this->postJson('/api/login', [
            'email' => $user,
            'password' => 'welovetracktik'
        ]);

        $response->assertStatus(200);
    }


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_fail_missing_password_parameter()
    {
        App::loadEnvironmentFrom('.env');
        $user = env('DUMMY_USER');
        $response = $this->postJson('/api/login', [
            'email' => $user,
        ]);

        $response->assertStatus(400);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login_fail_bad_password_response()
    {
        App::loadEnvironmentFrom('.env');
        $user = env('DUMMY_USER');
        $response = $this->postJson('/api/login', [
            'email' => $user,
            'password' => 'wedonotlovetracktik'
        ]);

        $response->assertStatus(403);
    }
}
