<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Schools\app\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SchoolPeopleTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->school = factory(School::class)
            ->create();

        $this->testModel = factory(Person::class)
            ->make();
    }

    /** @test */
    public function can_view_create_form()
    {
        $this->get(route('administration.schools.people.create', [$this->school->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_view_edit_form()
    {
        $this->setSchool();

        $this->get(route('administration.schools.people.edit', [$this->testModel->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_associate_person()
    {
        $this->testModel->save();
        $this->testModel->school_id = $this->school->id;

        $response = $this->post(
            route('administration.schools.people.store', [], false),
            $this->testModel->toArray()
        );

        Person::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    /** @test */
    public function can_update_person()
    {
        $this->setSchool();
        $this->testModel->position = 'updated';

        $this->patch(
            route('administration.schools.people.update', [$this->testModel->id], false),
            $this->testModel->toArray()
        )->assertStatus(200)
        ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->position);
    }

    /** @test */
    public function can_get_option_list()
    {
        $this->setSchool();

        $this->get(route('administration.people.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id' => $this->testModel->id,
        ]);
    }

    /** @test */
    public function can_dissociate_person()
    {
        $this->setSchool();

        $this->delete(route('administration.schools.people.destroy', [$this->testModel->id], false))
            ->assertStatus(200);

        $this->assertNull($this->testModel->fresh()->school_id);
    }

    public function setSchool()
    {
        $this->testModel->school_id = $this->school->id;
        $this->testModel->save();
    }
}
