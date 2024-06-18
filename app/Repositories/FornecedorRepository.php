<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Fornecedor $aux)
    {
        $this->relacao = 'fornecedores';
        $this->modelClass = $aux;
    }

    public function paginate($data, $qtd, $filtros = null)
    {   
        
        if ($filtros) {  

            return $this->modelClass::select($data)->where(function ($query) use ($filtros) {
                
                if ($filtros->has('busca')) {
                    $query->where('fornecedores.nome_fantasia', 'LIKE', "%{$filtros['busca']}%")->orWhere('fornecedores.cnpj', 'LIKE', "%{$filtros['busca']}%");
                }
            })->orderBy('fornecedores.id', 'asc')->paginate($qtd);
        }
            
        return $this->modelClass::select($data)->orderBy('id', 'asc')->paginate($qtd);
    }

    public function findOneEndereco($r)
    {
        $funcionario = $this->modelClass::find($r);
        $funcionario->endereco;
         
    }
    
}
