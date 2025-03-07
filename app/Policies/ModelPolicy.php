<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class ModelPolicy
{
    use HandlesAuthorization;

    public function view(User $user)
    {
        return true; // Ajusta según tus necesidades
    }
}