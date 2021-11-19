<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\Task;
use Database\Factories\ProjectFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_task_has_a_path()
    {
        $task = Task::factory()->create();

        $this->assertEquals(
            $task->path(),$task->project->path() . '/tasks/' . $task->id
        );
    }

    /** @test */
    function a_task_belongs_to_a_project()
    {
        $task = Task::factory()->create();

        $this->assertInstanceOf(Project::class, $task->project);
    }
}
