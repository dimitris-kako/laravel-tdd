<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

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
    function a_user_can_view_their_project()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $project = Project::factory()->create(['owner_id' => $user->id]);

        $this->get('/projects/' . $project->id)
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test */
    function a_user_cannot_view_project_of_others()
    {
        $this->be(User::factory()->create());

        $project = Project::factory()->create();

        $this->get($project->path())
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->be($user);

        $attributes = Project::factory()->raw(['owner_id' => $user->id]);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }


    /** @test */
    function quests_cannot_manages_projects()
    {
        $project = Project::factory()->create();

        $this->get(route('projects.index'))
            ->assertRedirect(route('login'));

        $this->post(route('projects.store'), $project->toArray())
            ->assertRedirect('/login');

        $this->get(route('projects.show', $project))
            ->assertRedirect(route('login'));

        $this->get(route('projects.create'))
            ->assertRedirect(route('login'));
    }
}
