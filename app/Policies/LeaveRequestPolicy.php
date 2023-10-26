<?php

namespace App\Policies;

use App\Models\LeaveRequest;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class LeaveRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, LeaveRequest $leaveRequest)
{
    return $user->employee_id === $leaveRequest->employee_id;
}
}
