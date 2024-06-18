<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{   
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(Authenticatable $user){
        if($user->role != null) {
            return $user->role->role_name === 'admin';
        }
    }   
    
    public function destroy(Authenticatable $user){
        if($user->role != null) {
            return $user->role->role_name === 'admin';
        }
    }
}
