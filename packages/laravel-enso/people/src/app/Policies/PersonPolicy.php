<?php

namespace LaravelEnso\People\app\Policies;

use LaravelEnso\People\app\Models\Person;
use Illuminate\Auth\Access\HandlesAuthorization;

class PersonPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->belongsToAdminGroup()) {
            return true;
        }
    }

    public function setCompany($user, Person $person)
    {
        return is_null($user->person->school_id)
            || $user->person->school_id === $person->school_id;
    }

    public function changeCompany($user, Person $person)
    {
        return false;
    }
}
