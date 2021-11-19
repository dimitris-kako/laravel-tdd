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
    function a_task_requires_a_body()
    {
        $this->signIn();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $task_attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $task_attributes)
            ->assertSessionHasErrors('body');
    }
}
