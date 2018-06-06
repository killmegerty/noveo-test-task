<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiGroupsTest extends TestCase
{
    public function testGetGroups()
    {
        $this->json('GET', '/api/groups')
             ->assertStatus(200)
             ->assertJsonStructure([
                 [
                     'id',
                     'name'
                 ]
             ]);
    }

    public function testGetGroupsId()
    {
        $this->json('GET', '/api/groups/1')
             ->assertStatus(200)
             ->assertExactJson([
                 'id' => 1,
                 'name' => 'Users',
             ]);
    }

    public function testPostGroups()
    {
        // test entity creation
        $payload = [
            'name' => 'some TEst GrOuP'
        ];

        $this->json('POST', '/api/groups', $payload)
             ->assertStatus(201)
             ->assertJson([
                 'id' => 4,
                 'name' => 'Some test group'
             ]);

        $this->assertDatabaseHas('groups', [
            'id' => 4,
            'name' => 'Some test group'
        ]);

        // test validation
        $payload = [
            'name' => 1
        ];

        $this->json('POST', '/api/groups', $payload)
             ->assertStatus(400)
             ->assertExactJson([
                 'name' => ['The name must be a string.']
             ]);
    }

    public function testPatchGroupsId()
    {
        // test entity update
        $payload = [
            'name' => 'updaTeD GroUp'
        ];

        $this->json('PATCH', '/api/groups/1', $payload)
             ->assertStatus(200)
             ->assertJson([
                 'id' => 1,
                 'name' => 'Updated group'
             ]);

        $this->assertDatabaseHas('groups', [
            'id' => 1,
            'name' => 'Updated group'
        ]);

        // test validation
        $payload = [
            'name' => 1,
        ];

        $this->json('PATCH', '/api/groups/1', $payload)
             ->assertStatus(400)
             ->assertExactJson([
                 'name' => ['The name must be a string.']
             ]);
    }
}
