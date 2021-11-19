<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Database\Factories\TaskFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_have_tasks()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $this->post($project->path() . '/tasks', ['body' => 'Test']);

        $this->get($project->path())
            ->assertSee('Test');
    }

    /** @test */
    function a_project_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $task = $project->tasks()->create(['body' => 'Test']);

        $task_attributes = [
            'body' => 'Test',
            'completed' => true,
        ];

        $this->patch($project->path() . '/tasks/' . $task->id, $task_attributes);

        $this->assertDatabaseHas('tasks', $task_attributes);
    }

    /** @test */
    function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $task_attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $task_attributes)
            ->assertSessionHasErrors('body');
    }

    /** @test */
    function guest_cannot_have_tasks_to_projects()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks')
            ->assertRedirect('login');
    }

    /** @test */
    function only_the_owner_of_a_project_can_add_tasks ()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $task_attributes = Task::factory()->raw();

        $this->post($project->path() . '/tasks', $task_attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $task_attributes);
    }

    /** @test */
    function only_the_owner_of_a_project_can_update_a_task ()
    {
        $this->signIn();

        $project = Project::factory()->create();

        $task = $project->add_task('Hello');

        $task_attributes = Task::factory()->raw();

        $this->patch($project->path() . '/tasks/' . $task->id, $task_attributes)
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', $task_attributes);
    }
}
