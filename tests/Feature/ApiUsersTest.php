<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ApiUsersTest extends TestCase
{
    public function testGetUsers()
    {
        $this->json('GET', '/api/users')
             ->assertStatus(200)
             ->assertJsonStructure([
                 [
                     'id',
                     'email',
                     'first_name',
                     'last_name',
                     'state',
                     'group_id'
                 ]
             ]);
    }

    public function testGetUsersId()
    {
        $this->json('GET', '/api/users/1')
             ->assertStatus(200)
             ->assertJsonStructure([
                 'id',
                 'email',
                 'first_name',
                 'last_name',
                 'state',
                 'group_id'
             ]);
    }

    public function testPostUsers()
    {
        // test entity creation
        $payload = [
            'email' => 'john228@gmail.com',
            'first_name' => 'John von',
            'last_name' => 'Neumann'
        ];

        $this->json('POST', '/api/users', $payload)
             ->assertStatus(201)
             ->assertJson([
                 'id' => 16,
                 'email' => $payload['email'],
                 'first_name' => $payload['first_name'],
                 'last_name' => $payload['last_name'],
                 'state' => USER::STATE_ACTIVE,
                 'group_id' => 1
             ]);

        $this->assertDatabaseHas('users', [
            'id' => 16,
            'email' => $payload['email'],
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'state' => USER::STATE_ACTIVE,
            'group_id' => 1
        ]);

        // test validation
        $payload = [
            'state' => 'wrongstatestatus',
            'first_name' => 1,
            'last_name' => 1,
            'email' => 'wrongemail',
            'group_id' => 'typestring'
        ];

        $this->json('POST', '/api/users', $payload)
             ->assertStatus(400)
             ->assertExactJson([
                 'email' => ['The email must be a valid email address.'],
                 'first_name' => ['The first name must be a string.'],
                 'last_name' => ['The last name must be a string.'],
                 'group_id' => ['The group id must be an integer.'],
                 'state' => ['The selected state is invalid.']
             ]);
    }

    public function testPatchUsersId()
    {
        // test entity update
        $payload = [
            'email' => 'john228@gmail.com',
            'first_name' => 'John von',
            'last_name' => 'Neumann',
            'group_id' => 10,
            'state' => USER::STATE_ACTIVE
        ];

        $this->json('PATCH', '/api/users/1', $payload)
             ->assertStatus(200)
             ->assertJson([
                 'id' => 1,
                 'email' => $payload['email'],
                 'first_name' => $payload['first_name'],
                 'last_name' => $payload['last_name'],
                 'state' => USER::STATE_ACTIVE,
                 'group_id' => 10
             ]);

        $this->assertDatabaseHas('users', [
            'id' => 1,
            'email' => $payload['email'],
            'first_name' => $payload['first_name'],
            'last_name' => $payload['last_name'],
            'state' => USER::STATE_ACTIVE,
            'group_id' => 10
        ]);

        // test validation
        $payload = [
            'state' => 'wrongstatestatus',
            'first_name' => 1,
            'last_name' => 1,
            'email' => 'wrongemail',
            'group_id' => 'typestring'
        ];

        $this->json('PATCH', '/api/users/1', $payload)
             ->assertStatus(400)
             ->assertExactJson([
                 'email' => ['The email must be a valid email address.'],
                 'first_name' => ['The first name must be a string.'],
                 'last_name' => ['The last name must be a string.'],
                 'group_id' => ['The group id must be an integer.'],
                 'state' => ['The selected state is invalid.']
             ]);
    }
}
