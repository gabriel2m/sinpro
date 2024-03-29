<?php

namespace Tests\Feature\Auth\User;

use App\Models\User;
use Tests\TestCase;

class UserProfileInformationUpdateTest extends TestCase
{
    public function test_post()
    {
        $this
            ->actingAsRandom()
            ->put(
                route('user-profile-information.update'),
                $data = User::factory()->makeOne()->only(['name', 'email'])
            )
            ->assertRedirect()
            ->assertSessionHasNoErrors();

        $this->assertDatabaseHas(User::class, $data);
        $this->assertDatabaseCount(User::class, 1);
    }
}
