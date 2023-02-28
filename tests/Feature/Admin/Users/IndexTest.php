<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;

class IndexTest extends TestCase
{
    public function test_get()
    {
        $this
            ->actingAsAdmin()
            ->get(route('admin.users.index'))
            ->assertOk();
    }
}
