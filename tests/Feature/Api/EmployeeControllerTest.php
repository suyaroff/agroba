<?php

use App\Models\Employee;
use App\Models\User;

test('cannot create employee with empty data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->postJson('/api/employees', []);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'last_name', 'position']);
});

test('cannot create employee with invalid data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->postJson('/api/employees', [
        'first_name' => '',
        'last_name' => '',
        'position' => '',
        'phone' => 'invalid-phone',
        'passport_number' => 'invalid'
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'last_name', 'position', 'phone', 'passport_number']);
});

test('cannot create employee when unauthenticated', function () {
    $employee = Employee::factory()->make()->toArray();

    $response = $this->postJson('/api/employees', $employee);

    $response->assertStatus(401);
});

test('create employee', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->make()->toArray();

    $response = $this->postJson('/api/employees', $employee);

    $response->assertStatus(201)->assertJson(['data' => $employee]);
});

test('cannot get employees when unauthenticated', function () {
    $response = $this->getJson('/api/employees');

    $response->assertStatus(401);
});

test('can get empty employees list', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->getJson('/api/employees');

    $response->assertStatus(200)
        ->assertJson(['data' => []]);
});

test('can get employees list', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employees = Employee::factory(15)->create();

    $response = $this->getJson('/api/employees');

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

test('cannot get employee details when unauthenticated', function () {
    $employee = Employee::factory()->create();

    $response = $this->getJson("/api/employees/{$employee->id}");

    $response->assertStatus(401);
});

test('can get employee details', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->create();

    $response = $this->getJson("/api/employees/{$employee->id}");

    $response->assertStatus(200)
        ->assertJson(['data' => $employee->toArray()]);
});

test('returns 404 when employee not found', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->getJson('/api/employees/999');

    $response->assertStatus(404);
});

test('cannot update employee when unauthenticated', function () {
    $employee = Employee::factory()->create();
    $updatedData = Employee::factory()->make()->toArray();

    $response = $this->putJson("/api/employees/{$employee->id}", $updatedData);

    $response->assertStatus(401);
});

test('cannot update employee with invalid data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->create();

    $response = $this->putJson("/api/employees/{$employee->id}", [
        'first_name' => str_repeat('a', 51),
        'last_name' => str_repeat('a', 51),
        'position' => str_repeat('a', 51),
        'phone' => 'invalid-phone',
        'passport_number' => str_repeat('a', 51)
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['first_name', 'last_name', 'position', 'phone', 'passport_number']);
});

test('cannot update employee with empty data', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->create();

    $response = $this->putJson("/api/employees/{$employee->id}", []);

    $response->assertStatus(422);
});

test('can update employee', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->create(['enterprise_id' => 1]);
    $updatedData = Employee::factory()->make()->toArray();

    $response = $this->putJson("/api/employees/{$employee->id}", $updatedData);

    $response->assertStatus(200)
        ->assertJson(['data' => $updatedData]);
});

test('cannot update employee from another enterprise', function () {
    $userBob = User::where('id', 2)->first();
    $this->actingAs($userBob);
    $employee = Employee::factory()->create(['enterprise_id' => 1]);
    $updatedData = Employee::factory()->make()->toArray();

    $response = $this->putJson("/api/employees/{$employee->id}", $updatedData);

    $response->assertStatus(403);
});

test('returns 404 when updating non-existent employee', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $updatedData = Employee::factory()->make()->toArray();

    $response = $this->putJson('/api/employees/999', $updatedData);

    $response->assertStatus(404);
});

test('cannot delete employee when unauthenticated', function () {
    $employee = Employee::factory()->create();

    $response = $this->deleteJson("/api/employees/{$employee->id}");

    $response->assertStatus(401);
});

test('can delete employee', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);
    $employee = Employee::factory()->create(['enterprise_id' => 1]);

    $response = $this->deleteJson("/api/employees/{$employee->id}");

    $response->assertStatus(200);
    $response->assertJson(['message' => 'Employee deleted successfully']);
    $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
});

test('returns 404 when deleting non-existent employee', function () {
    $user = User::where('id', 1)->first();
    $this->actingAs($user);

    $response = $this->deleteJson('/api/employees/999');

    $response->assertStatus(404);
});

test('cannot delete employee from another enterprise', function () {
    $userBob = User::where('id', 2)->first();
    $this->actingAs($userBob);
    $employee = Employee::factory()->create(['enterprise_id' => 1]);

    $response = $this->deleteJson("/api/employees/{$employee->id}");

    $response->assertStatus(403);
});




