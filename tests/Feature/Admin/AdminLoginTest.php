<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test*/
    function logging_in_as_an_admin(){
        $this->withoutExceptionHandling();

        $email = 'admin@test.com';
        $password = 'laravel';

        $admin=$this->createAdmin([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->post('admin/login', compact('email', 'password'))
            ->assertRedirect('admin');

        $this->assertAuthenticatedAs($admin, 'admin');
    }
    /** @test*/
    function cannot_login_with_invalid_credentials(){
        $this->withExceptionHandling();

        $email = 'admin@test.com';
        $password = 'laravel';

        $admin=$this->createAdmin([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->post('admin/login', ['email' => $email, 'password' => bcrypt('codeigniter')])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'These credentials do not match our records.'
            ]);
        // $this->postJson('admin/login', ['email' => $email, 'password' => bcrypt('codeigniter')])
        //     ->assertStatus(422);

        $this->assertGuest();
    }

    /** @test*/
    function cannot_login_with_user_credentials(){
        $this->withExceptionHandling();

        $email = 'user@test.com';
        $password = 'laravel';

        $admin=$this->createUser([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $this->post('admin/login', compact('email', 'password'))
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'email' => 'These credentials do not match our records.'
            ]);
        // $this->postJson('admin/login', ['email' => $email, 'password' => bcrypt('codeigniter')])
        //     ->assertStatus(422);

        $this->assertGuest();
    }
}
