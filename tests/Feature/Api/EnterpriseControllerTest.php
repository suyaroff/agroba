<?php

use App\Models\Enterprise;
use \App\Models\User;


test('cannot create enterprise with empty data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->postJson('/api/enterprises', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email']);
});


test('cannot create enterprise with invalid data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->postJson('/api/enterprises', [
        'name' => '',
        'email' => 'invalid-email'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email']);
});


test('cannot create enterprise when unauthenticated', function () {
    $enterprise = Enterprise::factory()->make()->toArray();

    $response = $this->postJson('/api/enterprises', $enterprise);

    $response->assertStatus(401);
});


test('create enterprise', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->make()->toArray();

    $response = $this->postJson('/api/enterprises', $enterprise);

    $response->assertStatus(201)->assertJson(['data' => $enterprise]);
});


test('cannot get enterprises when unauthenticated', function () {
    $response = $this->getJson('/api/enterprises');

    $response->assertStatus(401);
});


test('can get empty enterprises list', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->getJson('/api/enterprises');

    $response->assertStatus(200)
        ->assertJson(['data' => []]);
});


test('can get enterprises list', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprises = Enterprise::factory(15)->create();

    $response = $this->getJson('/api/enterprises');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'data',
            'links' => ['first', 'last', 'prev', 'next'],
            'meta' => [
                'current_page',
                'from',
                'last_page',
                'links',
                'path',
                'per_page',
                'to',
                'total'
            ]
        ]);
});


test('cannot get enterprise details when unauthenticated', function () {
    $enterprise = Enterprise::factory()->create();

    $response = $this->getJson("/api/enterprises/{$enterprise->id}");

    $response->assertStatus(401);
});


test('can get enterprise details', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->create();

    $response = $this->getJson("/api/enterprises/{$enterprise->id}");

    $response->assertStatus(200)
        ->assertJson(['data' => $enterprise->toArray()]);
});


test('returns 404 when enterprise not found', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->getJson('/api/enterprises/999');

    $response->assertStatus(404);
});


test('cannot update enterprise when unauthenticated', function () {
    $enterprise = Enterprise::factory()->create();
    $updatedData = Enterprise::factory()->make()->toArray();

    $response = $this->putJson("/api/enterprises/{$enterprise->id}", $updatedData);

    $response->assertStatus(401);
});


test('cannot update enterprise with invalid data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->create();

    $response = $this->putJson("/api/enterprises/{$enterprise->id}", [
        'name' => str_repeat('a', 256),
        'director_name' => str_repeat('a', 51),
        'email' => 'invalid-email',
        'website' => str_repeat('a', 51),
        'phone' => 'invalid-phone'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'phone', 'name', 'director_name', 'website']);
});


test('cannot update enterprise with empty data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->create();

    $response = $this->putJson("/api/enterprises/{$enterprise->id}", []);
    $response->assertStatus(422);
});


test('can update enterprise', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->create();
    $updatedData = Enterprise::factory()->make()->toArray();

    $response = $this->putJson("/api/enterprises/{$enterprise->id}", $updatedData);

    $response->assertStatus(200)
        ->assertJson(['data' => $updatedData]);
});


test('cannot update enterprise owned by another user', function () {
    $userBob = User::where('id', 2)->first();
    $this->actingAs($userBob);
    $enterprise = Enterprise::factory()->create(['owner_id' => 1]);
    $updatedData = Enterprise::factory()->make()->toArray();

    $response = $this->putJson("/api/enterprises/{$enterprise->id}", $updatedData);

    $response->assertStatus(403);

});

test('returns 404 when updating non-existent enterprise', function () {

    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $updatedData = Enterprise::factory()->make()->toArray();

    $response = $this->putJson('/api/enterprises/999', $updatedData);

    $response->assertStatus(404);
});

test('cannot delete enterprise when unauthenticated', function () {
    $enterprise = Enterprise::factory()->create();

    $response = $this->deleteJson("/api/enterprises/{$enterprise->id}");

    $response->assertStatus(401);
});

test('can delete enterprise', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $enterprise = Enterprise::factory()->create(['owner_id' => 1]);

    $response = $this->deleteJson("/api/enterprises/{$enterprise->id}");

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Enterprise deleted successfully']);
    $this->assertDatabaseMissing('enterprises', ['id' => $enterprise->id]);
});

test('returns 404 when deleting non-existent enterprise', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->deleteJson('/api/enterprises/999');

    $response->assertStatus(404);
});

test('cannot delete enterprise owned by another user', function () {
    $userBob = User::where('id', 2)->first();
    $this->actingAs($userBob);
    $enterprise = Enterprise::factory()->create(['owner_id' => 1]);

    $response = $this->deleteJson("/api/enterprises/{$enterprise->id}");

    $response->assertStatus(403);
});










