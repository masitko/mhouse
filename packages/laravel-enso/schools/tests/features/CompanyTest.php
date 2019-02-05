<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Schools\app\Models\School;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\EditForm;
use LaravelEnso\FormBuilder\app\TestTraits\DestroyForm;
use LaravelEnso\VueDatatable\app\Traits\Tests\Datatable;

class SchoolTest extends TestCase
{
    use Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'administration.schools';
    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = factory(School::class)
            ->make();
    }

    /** @test */
    public function can_view_create_form()
    {
        $this->get(route($this->permissionGroup.'.create', false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_store_school()
    {
        $response = $this->post(
            route('administration.schools.store', [], false),
            $this->testModel->toArray()
        );

        $school = School::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message'])
            ->assertJsonFragment([
                'redirect' => 'administration.schools.edit',
                'param' => ['school' => $school->id],
            ]);
    }

    /** @test */
    public function can_update_school()
    {
        $this->testModel->save();

        $this->testModel->name = 'updated';

        $this->patch(
            route('administration.schools.update', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200)
        ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->name);
    }

    /** @test */
    public function get_option_list()
    {
        $this->testModel->save();

        $this->get(route('administration.schools.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))
        ->assertStatus(200)
        ->assertJsonFragment([
            'name' => $this->testModel->name,
        ]);
    }
}
