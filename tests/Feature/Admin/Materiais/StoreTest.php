<?php

namespace Tests\Feature\Admin\Materiais;

use App\Models\Material;
use Tests\TestCase;

class StoreTest extends TestCase
{
    public function test_post()
    {
        $this
            ->actingAsRandom()
            ->post(route('admin.materiais.store'), $data = Material::factory()->makeOne()->attributesToArray())
            ->assertRedirect();

        $this->assertDatabaseHas(Material::class, $data);
        $this->assertDatabaseCount(Material::class, 1);
    }
}
