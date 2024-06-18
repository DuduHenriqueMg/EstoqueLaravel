<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;

class FuncionarioRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Funcionario $aux)
    {
        $this->relacao = 'funcionarios';
        $this->modelClass = $aux;
    }

    public function paginate($data, $qtd, $filtros = null)
    {   
        
        if ($filtros) {  

            return $this->modelClass::select($data)->where(function ($query) use ($filtros) {
                
                if ($filtros->has('busca')) {
                    $query->where('funcionarios.nome', 'LIKE', "%{$filtros['busca']}%");
                }
                
            })->orderBy('funcionarios.id', 'asc')->paginate($qtd);
        }
            
        return $this->modelClass::select($data)->orderBy('id', 'asc')->paginate($qtd);
    }


    public function findOneEndereco($r)
    {
        $funcionario = $this->modelClass::find($r);
        $funcionario->endereco;
         
    }
    
}
