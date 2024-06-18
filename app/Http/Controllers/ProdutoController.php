<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;
use Inertia\Response;
use App\Repositories\ProdutoRepository;
use App\Repositories\FornecedorRepository;


class ProdutoController extends CrudController
{

    public function __construct(ProdutoRepository $class, FornecedorRepository $fornecedor)
    {   
        $this->class = $class;
        $this->route = 'Produto';
        $this->atributes = ['id', 'lote', 'valor', 'quantidade', 'descricao', 'categoria', 'fornecedor_id'];
        $this->titulos = [ 'id', 'Lote', 'Valor', 'Quantidade', 'Descrição', 'Categoria', 'Fornecedor'];
        $this->acao = ['detalhe', 'editar', 'apagar'];
        $this->fornecedores = $fornecedor->all();
        $this->categorias = $class->categorias();
              
    }

 
    public function index(Request $request, $msg = null) : Response
    {   
        $msg = session()->get('mensagem');
        $data = $this->class->paginate($this->atributes, 10);
       
        if ($request->hasAny(['busca'])) { 
            $data = $this->class->paginate($this->atributes, 10, $request->collect())->withQueryString();    
              
            if (!$data->items()) {
                $msg = "Nada encontrado";
            }
        }

        return Inertia::render($this->route.'/Index',
                                [  
                                    'itens'=>$data,
                                    'titulos'=>$this->titulos,
                                    'atributes'=>$this->atributes,
                                    'acao'=>$this->acao,
                                    'rota'=>$this->route,
                                    'fornecedores'=>$this->fornecedores,
                                    'categorias' => $this->categorias,
                                    'msg'=>$msg
                                    
                                ]);
    }


    
}
