<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function Symfony\Component\String\u;

class ProjectTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    function it_has_a_path()
    {
        $project = Project::factory()->create();

        $this->assertEquals(route('projects.show', $project), url($project->path()) );
    }

    /** @test */
    function it_belongs_to_user()
    {
        $project = Project::factory()->create();
        $user = $project->owner;

        $this->assertEquals($user, $project->owner);
    }
}
