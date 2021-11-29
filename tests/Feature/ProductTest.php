<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     * 
     * 상품조회 테스트
     *
     * @return void
     */
    public function test_example()
    {
        $user = User::where( 'id', 20 )->first();
        $token = $user->createToken(env('APP_KEY'))->plainTextToken;
       
        $headers = [
            'Accept'        => 'application/vnd.laravel.v1+json',
            'AUTHORIZATION' => 'Bearer ' . $token
            ];
       
        //$response = $this->withHeaders($headers)->json('get', '/api/product', []);
        $response = $this->withHeaders($headers)->json('get', '/api/product/search/'.$user['email'], []);

        $response
            ->assertStatus(200)
            ->assertJson([
                'result' => 'Y',
            ]);
        

    }
}
