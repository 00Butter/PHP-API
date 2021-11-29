<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *  로그인 테스트
     * @return void
     */
    public function test_example()
    {
        $user = User::where( 'id', 20 )->first();
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
     
        $response = $this->postJson('/api/login',['email'=>$user->email,'password'=>'Test123!!!'])->dump();

        $response
            ->assertStatus(202)
            ->assertJson([
                'result' => 'Y',
            ]);
        
       
        $headers = [
            'Accept'        => 'application/vnd.laravel.v1+json',
            'AUTHORIZATION' => 'Bearer ' . $token
            ];
        
        $response = $this->post('api/logout', [], $headers)
                ->dump();
        $response
            ->assertStatus(200)
            ->assertJson([
                'result' => 'Y',
            ]);

    }
}
