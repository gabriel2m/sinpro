<?php

namespace Tests\Feature\Auth\User;

use App\Models\User;
use Database\Factories\UserFactory;
use Tests\TestCase;

class UserPasswordUpdate extends TestCase
{
    public function test_post()
    {
        /** @var User */
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->put(route('user-password.update'), [
                'current_password' => UserFactory::$default_password,
                'password' => $password = $this->faker->password(),
                'password_confirmation' => $password,
            ])
            ->assertRedirect();

        $this->assertCredentials(['name' => $user->name, 'password' => $password]);
    }
}
