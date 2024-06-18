<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Endereco;
use Illuminate\Support\Facades\DB;

class EnderecoRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Endereco $aux)
    {
        $this->relacao = 'enderecos';
        $this->modelClass = $aux;
    }

   
}
