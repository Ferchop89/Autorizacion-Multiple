<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Blade;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomDirectivesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertFalse(Blade::check('admin'));
    }
}
