<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\TeamClientManager;
use Livewire\Livewire;
use Tests\TestCase;

class RemoveTeamClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_members_can_be_removed_from_teams(): void
    {
        $this->actingAs($user = User::factory()->withPersonalTeam()->create());

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $component = Livewire::test(TeamClientManager::class, ['team' => $user->currentTeam])
                        ->set('teamClientIdBeingRemoved', $otherUser->id)
                        ->call('removeTeamClient');

        $this->assertCount(0, $user->currentTeam->fresh()->users);
    }

    public function test_only_team_owner_can_remove_team_members(): void
    {
        $user = User::factory()->withPersonalTeam()->create();

        $user->currentTeam->users()->attach(
            $otherUser = User::factory()->create(), ['role' => 'admin']
        );

        $this->actingAs($otherUser);

        $component = Livewire::test(TeamClientManager::class, ['team' => $user->currentTeam])
                        ->set('teamClientIdBeingRemoved', $user->id)
                        ->call('removeTeamClient')
                        ->assertStatus(403);
    }
}
