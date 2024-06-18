<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Role $aux)
    {
        $this->relacao = 'roles';
        $this->modelClass = $aux;
    }

    
}
