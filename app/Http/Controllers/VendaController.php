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
use App\Repositories\VendaRepository;
use App\Repositories\ProdutoRepository;
use App\Repositories\FuncionarioRepository;
use App\Repositories\ClienteRepository;


class VendaController extends CrudController
{

    public function __construct(VendaRepository $class, FuncionarioRepository $funcionario, ClienteRepository $cliente)
    {   
        $this->class = $class;
        $this->route = 'Vendas';
        $this->atributes = ['vendas.id', 'data', 'valor', 'funcionario_id', 'cliente_id', 'funcionarios.nome', 'clientes.nome as nome_cliente'];
        $this->titulos = [ 'id', 'data', 'Valor', 'Funcionario', 'Cliente'];
        $this->acao = ['detalhe', '', 'apagar'];
        $this->funcionarios = $funcionario->all();
        $this->clientes = $cliente->all();
              
    }

    public function index(Request $request, $msg = null) : Response
    {   
        $msg = session()->get('mensagem');
        $data = $this->class->paginateWithProdutos(10);
        
       
        if ($request->hasAny(['busca'])) { 
            $data = $this->class->paginateWithProdutos(10, $request->collect())->withQueryString();    
              
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
                                    'funcionarios'=>$this->funcionarios,
                                    'clientes' => $this->clientes,
                                    'msg'=>$msg
                                    
                                ]);
    }


    
}
