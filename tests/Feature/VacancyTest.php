<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use JWTAuth;

class VacancyTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    protected function authenticate(){
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('secret1234'),
        ]);
        $token = JWTAuth::fromUser($user);
        return $token;
    }

    public function testAdminCanPostVacancy()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('POST', '/api/v1/admin/vacancy',[
            'title' => 'Tech lead',
            'company' => 'Parboil inc',
            'location' => 'Nairobi',
            'status' => 'open',
            'description' => 'lorem ipsum is used!'
        ]);
        $response->assertStatus(200);
    }

    public function testAdminCanGetAllVacancies()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET', '/api/v1/admin/vacancy');
        $response->assertStatus(200);
    }
}
