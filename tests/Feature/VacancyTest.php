<?php

namespace Tests\Feature;

use App\User;
use App\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    protected function userAuthenticate(){
        $user = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'role' => 'user',
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

    public function testAdminCanGetVacancyDetails(){
        $vacancy = Vacancy::create([
            'title' => 'Tech lead',
            'company' => 'Parboil inc',
            'location' => 'Nairobi',
            'status' => 'open',
            'description' => 'lorem ipsum is used!'
        ]);

        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET', '/api/v1/admin/vacancy/' . 1);
        $response->assertStatus(200);
        Vacancy::where('id', 1)->delete();
    }

    public function testUserCanGetOpenVacancies(){
        $vacancy = Vacancy::create([
            'title' => 'Tech lead',
            'company' => 'Parboil inc',
            'location' => 'Nairobi',
            'status' => 'open',
            'description' => 'lorem ipsum is used!'
        ]);

        $token = $this->userAuthenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET', '/api/v1/vacancy');
        $response->assertStatus(200);
        Vacancy::where('id', 1)->delete();
    }

    public function testUserCanGetVacancyDetails(){
        $vacancy = Vacancy::create([
            'title' => 'Tech lead',
            'company' => 'Parboil inc',
            'location' => 'Nairobi',
            'status' => 'open',
            'description' => 'lorem ipsum is used!'
        ]);

        $token = $this->userAuthenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET', '/api/v1/vacancy/' . 1);
        $response->assertStatus(200);
        Vacancy::where('id', 1)->delete();
    }
}
