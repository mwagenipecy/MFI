<?php

namespace Laravel\Jetstream\Actions;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Events\TeamClientUpdated;
use Laravel\Jetstream\Jetstream;
use Laravel\Jetstream\Rules\Role;

class UpdateTeamClientRole
{
    /**
     * Update the role for the given team member.
     *
     * @param  mixed  $user
     * @param  mixed  $team
     * @param  int  $teamClientId
     * @param  string  $role
     * @return void
     */
    public function update($user, $team, $teamClientId, string $role)
    {
        Gate::forUser($user)->authorize('updateTeamClient', $team);

        Validator::make([
            'role' => $role,
        ], [
            'role' => ['required', 'string', new Role],
        ])->validate();

        $team->users()->updateExistingPivot($teamClientId, [
            'role' => $role,
        ]);

        TeamClientUpdated::dispatch($team->fresh(), Jetstream::findUserByIdOrFail($teamClientId));
    }
}
