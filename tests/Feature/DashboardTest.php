<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    /** @test */
    function it_shows_the_dashboard_page_to_authenticated_users(){
        $user = factory(User::class)->create();

        $this->actingAs($user) //Actuar como este usuario
            ->get(route('home'))
            ->assertSee('Dashboard')
            ->assertStatus(200);
    }

    /** @test */
    function it_redirects_guest_users_to_the_login_page(){
        $this->get(route('home'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}