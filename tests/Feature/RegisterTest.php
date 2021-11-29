<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     * 회원가입테스트
     * @return void
     */
    public function test_example()
    {
        $user = User::factory()->definition();
        $user['name'] = "ABSCDSD";
        $user['nickname'] = "abcdsssa";
        $user['password'] = "Abcdsass234@";

        dump($user);
        
        $response = $this->postJson( '/api/register',$user);

        $response
            ->assertStatus(201)
            ->assertJson([
                'result' => 'Y',
            ]);
        
    }
}
