<?php

namespace Tests\Feature\Api\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create();
        $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password', // assuming the factory sets this as the default password
        ])->assertStatus(200)
          ->assertJsonStructure([
              'token',
              'user' => [
                  'id',
                  'name',
                  'email',
                  // other user fields
              ],
          ]); 
    }

    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);
        $response->assertStatus(422)
                 ->assertJsonValidationErrors('email');

    }

    // testar se o usuario pode se registrar e receber um token
    public function test_user_can_register_and_receive_token(): void
    {
        $payload = [
            'name' => 'new name',
            'email' => $email = 'fer@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

          $response = $this->postJson('/api/auth/register', $payload);
          $response->assertCreated();
          $response->assertJsonStructure([
              'token',
              'user',]);

         $this->assertDatabaseHas('users', [
             'email' => $email,
         ]);


    
    }

    public function test_user_cannot_register_with_invalid_data(): void
    {
        $payload = [
            'name' => '',
            'email' => 'not-an-email',
            'password' => 'short',
            'password_confirmation' => 'mismatch',
        ];

        $response = $this->postJson('/api/auth/register', $payload);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    public function test_user_can_logout_and_token_is_revoked(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

       $response = $this->withHeaders([
           'Authorization' => 'Bearer ' . $token,
       ])->postJson('/api/auth/logout');

       $this->app['auth']->forgetGuards();
       
       $response->assertNoContent();

       $protected = $this->withHeaders([
           'Authorization' => 'Bearer ' . $token,
       ])->getJson('/api/user');
       $protected->assertStatus(401);
       
    }

  
}
