<?php

use App\Models\User;

use function Pest\Laravel\actingAs;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    /** @var User $user */
    $user = User::factory()->create();
    actingAs($user)
        ->get('/dashboard')
        ->assertStatus(200);
});
