<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;

class ClienteRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Cliente $aux)
    {
        $this->relacao = 'clientes';
        $this->modelClass = $aux;
    }

    public function paginate($data, $qtd, $filtros = null)
    {   
        
        if ($filtros) {  

            return $this->modelClass::select($data)->where(function ($query) use ($filtros) {
                
                if ($filtros->has('busca')) {
                    $query->where('clientes.nome', 'LIKE', "%{$filtros['busca']}%");
                }
                
            })->orderBy('clientes.id', 'asc')->paginate($qtd);
        }
            
        return $this->modelClass::select($data)->orderBy('id', 'asc')->paginate($qtd);
    }


    public function findOneEndereco($r)
    {
        $funcionario = $this->modelClass::find($r);
        $funcionario->endereco;
         
    }
    
}
