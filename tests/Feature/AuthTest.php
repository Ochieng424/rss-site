<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $data = [
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'password' => 'secret1234',
        ];

        $response = $this->json('POST','/api/v1/auth/register', $data);

        $response->assertStatus(200);

        User::where('email','test@gmail.com')->delete();
    }

    public function testLogin(){
        User::create([
            'email' => 'test@gmail.com',
            'name' => 'Test',
            'role' => 'user',
            'password' => bcrypt('secret1234'),
        ]);

        $data = [
            'email' => 'test@gmail.com',
            'password' => 'secret1234',
        ];

        $response = $this->json('POST','/api/v1/auth/login', $data);
        $response->assertStatus(200);
        $response->assertHeader('Authorization', $value = null);

        User::where('email','test@gmail.com')->delete();
    }
}
