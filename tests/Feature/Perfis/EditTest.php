<?php

namespace Tests\Feature\Perfis;

use App\Models\Perfil;
use Tests\TestCase;

class EditTest extends TestCase
{
    public function test_get()
    {
        $this
            ->actingAsEditor()
            ->get(route('perfis.edit', Perfil::factory()->create()))
            ->assertOk();
    }
}
