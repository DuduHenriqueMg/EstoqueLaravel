<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;

class ProdutoRepository extends BaseRepository
{

    public $modelClass;

    public function __construct(Produto $aux)
    {
        $this->relacao = 'produtos';
        $this->modelClass = $aux;
        
    }

    public function paginate($data, $qtd, $filtros = null)
    {   
        
        if ($filtros) {  

            return $this->modelClass::select($data)->where(function ($query) use ($filtros) {
                
                if ($filtros->has('busca')) {
                    $query->where('produtos.descricao', 'LIKE', "%{$filtros['busca']}%");
                }

                if ($filtros->has('categoria')) {
                    $query->where('produtos.categoria' , $filtros['categoria']);
                }
                
            })->orderBy('produtos.id', 'asc')->paginate($qtd);
        }
            
        return $this->modelClass::select($data)->orderBy('id', 'asc')->paginate($qtd);
    }

    public function categorias(){
        return $this->modelClass->distinct()->pluck('categoria');
    }

    public function findOneFornecedor($r)
    {
        $produto = $this->modelClass::find($r);
        $produto->fornecedor;
         
    }
    
}
