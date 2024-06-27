<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\RemovesTeamClients;
use Laravel\Jetstream\Events\TeamClientRemoved;

class RemoveTeamClient implements RemovesTeamClients
{
    /**
     * Remove the team member from the given team.
     */
    public function remove(User $user, Team $team, User $teamClient): void
    {
        $this->authorize($user, $team, $teamClient);

        $this->ensureUserDoesNotOwnTeam($teamClient, $team);

        $team->removeUser($teamClient);

        TeamClientRemoved::dispatch($team, $teamClient);
    }

    /**
     * Authorize that the user can remove the team member.
     */
    protected function authorize(User $user, Team $team, User $teamClient): void
    {
        if (! Gate::forUser($user)->check('removeTeamClient', $team) &&
            $user->id !== $teamClient->id) {
            throw new AuthorizationException;
        }
    }

    /**
     * Ensure that the currently authenticated user does not own the team.
     */
    protected function ensureUserDoesNotOwnTeam(User $teamClient, Team $team): void
    {
        if ($teamClient->id === $team->owner->id) {
            throw ValidationException::withMessages([
                'team' => [__('You may not leave a team that you created.')],
            ])->errorBag('removeTeamClient');
        }
    }
}
