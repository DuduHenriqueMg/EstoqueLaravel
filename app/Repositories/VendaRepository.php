<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class VendaRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Venda $aux)
    {
        $this->relacao = 'vendas';
        $this->modelClass = $aux;
    }

    public function paginate($data, $qtd, $filtros = null)
    {   
        
        if ($filtros) {  

            return $this->modelClass::leftJoin('funcionarios', 'vendas.funcionario_id', '=', 'funcionarios.id'  )->leftJoin('clientes', 'vendas.cliente_id', '=', 'clientes.id'  )->select($data)->where(function ($query) use ($filtros) {
                
                if ($filtros->has('busca')) {
                    $query->where('funcionarios.nome', 'LIKE', "%{$filtros['busca']}%")->orWhere('clientes.nome', 'LIKE', "%{$filtros['busca']}%");
                }

                
                
            })->orderBy('vendas.id', 'asc')->paginate($qtd);
        }
            
        return $this->modelClass::leftJoin('funcionarios', 'vendas.funcionario_id', '=', 'funcionarios.id'  )->leftJoin('clientes', 'vendas.cliente_id', '=', 'clientes.id'  )->select($data)->orderBy('vendas.id', 'asc')->paginate($qtd);
    }


    public function findOneEndereco($r)
    {
        $funcionario = $this->modelClass::find($r);
        $funcionario->endereco;
         
    }
    
}
