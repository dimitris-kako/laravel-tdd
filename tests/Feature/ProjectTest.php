<?php

namespace Tests\Feature;

use App\Models\Project;
use Database\Factories\ProjectFactory;
use http\Client\Curl\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->title,
            'description' => $this->faker->text,
        ];

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */
    function a_project_requires_a_title()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    function a_project_requires_a_description()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post(route('projects.store'), $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    function a_user_can_view_a_project()
    {
        $this->actingAs(\App\Models\User::factory()->create());

        $project = Project::factory()->create();

        $this->get('/projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    function only_authenticated_users_can_create_projects()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(\App\Models\User::factory()->create());

        $attributes = Project::factory()->raw();

        $this->post(route('projects.store'), $attributes)
            ->assertRedirect('/login');
    }
}
