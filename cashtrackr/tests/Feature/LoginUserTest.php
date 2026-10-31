<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('shows the login screen', function () {
    $response = $this->get(route('login'));
    $response->assertOk();
});

it('logs in a verified user successfully', function () {
    User::factory()->create([
        'email' => 'jhoan@jhoan.com',
        'password' => bcrypt('9881923819jHoan.'),
        'email_verified_at' => now()
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'jhoan@jhoan.com',
        'password' => '9881923819jHoan.',
    ]);

    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
});

it('does not log in with invalid credentials', function () {
    User::factory()->create([
        'email' => 'jhoan@jhoan.com',
        'password' => bcrypt('9881923819jHoan.'),
        'email_verified_at' => now()
    ]);
    $response = $this->from(route('login'))->post(route('login.store'), [
        'email' => 'jhoan@jhoan.com',
        'password' => '9881923819jHoan...',
    ]);
    $response->assertRedirect(route('login'));
    $response->assertSessionHas('error', 'Credenciales incorrectas');
});

it('prevents unverified user from accessing dashboard', function() {
    User::factory()->unverified()->create([
        'email' => 'jhoan@jhoan.com',
        'password' => bcrypt('9881923819jHoan.'),
    ]);
    $response = $this->post(route('login.store'), [
        'email' => 'jhoan@jhoan.com',
        'password' => '9881923819jHoan.',
    ]);
    $response->assertRedirect(route('dashboard'));
    $this->assertAuthenticated();
    $dasboardResponse = $this->get(route('dashboard'));
    $dasboardResponse->assertRedirect(route('verification.notice'));
});

it('does not allow access to dashboard if email is not verified', function() {
    $user = User::factory()->create([
        'email_verified_at' => null
    ]);
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertRedirect(route('verification.notice'));
});

it('allow access to dashboard if email is verified', function() {
    $user = User::factory()->create([
        'email_verified_at' => now()
    ]);
    $response = $this->actingAs($user)->get(route('dashboard'));
    $response->assertOk();
});

it('fails login if user does not exist', function() {
    $response = $this->from(route('login'))->post(route('login.store', [
        'email' => 'cualquier@gmail.com',
        'password' => '12345678&Jsh.'
    ]));
    $response->assertRedirect(route('login'));
    $response->assertSessionHasErrors([
        'email' => 'No encontramos una cuenta con ese e-mail'
    ]);
    $this->assertGuest();
});
