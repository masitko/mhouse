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

    public function setSchool($user, Person $person)
    {
        return is_null($user->person->school_id)
            || $user->person->school_id === $person->school_id;
    }

    public function changeSchool($user, Person $person)
    {
        return false;
    }
}
