<?php

use App\Models\User;

test('login with empty credentials returns validation error', function () {
    $response = $this->postJson('/api/auth/login', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});

test('login with invalid email returns validation error', function () {
    $response = $this->postJson('/api/auth/login', [
        'email' => 'invalid-email',
        'password' => 'sh'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

test('login with non-existent user returns error', function () {
    $response = $this->postJson('/api/auth/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'password123'
    ]);

    $response->assertStatus(401)
        ->assertJson(['message' => 'Invalid credentials']);
});

test('login with incorrect password returns error', function () {
    $user = User::factory()->create();

    $response = $this->postJson('/api/auth/login', [
        'email' => $user->email,
        'password' => 'wrong-password'
    ]);

    $response->assertStatus(401)
        ->assertJson(['message' => 'Invalid credentials']);
});

test('successful login as Admin', function () {

    $response = $this->postJson('/api/auth/login', [
        'email' => 'admin@mail.com',
        'password' => 'admin'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
});


test('successful login as Bob', function () {

    $response = $this->postJson('/api/auth/login', [
        'email' => 'bob@mail.com',
        'password' => 'password'
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);
});




