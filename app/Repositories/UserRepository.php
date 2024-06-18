<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(User $aux)
    {
        $this->relacao = 'users';
        $this->modelClass = $aux;
    }
    
    public function select($data)
    {
        return $this->modelClass::leftJoin('roles', 'users.role_id', '=', 'roles.id')->select( $data)->get();
    }

    public function findOneRole($r)
    {
        $user = $this->modelClass::find($r);
        return $user->role;
    }
    
}
