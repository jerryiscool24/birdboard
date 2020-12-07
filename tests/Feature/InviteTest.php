<?php

namespace Tests\Feature;

use App\Http\Controllers\ProjectTasksController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use \Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;

class InviteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_project_can_invite_a_user()
    {
        $project = ProjectFactory::create();

        $project->invite($newUser = User::factory()->create());

        $this->signIn($newUser);

        $this->post(action([ProjectTasksController::class, 'store'], $project), $task = ['body' => 'Foo Task']);

        $this->assertDatabaseHas('tasks', $task);
    }
}
